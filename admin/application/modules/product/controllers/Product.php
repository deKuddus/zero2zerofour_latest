<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('product_model');
        $this->load->module('template');

    }

    public function index() {
        $this->data['table_page']  = TRUE;
        $this->data['view_module'] = 'product';
        $this->data['view_file']   = 'index';
        $this->data['title']       = 'Product | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function create() {
        $this->data['product_page'] = TRUE;
        $this->data['categories']   = $this->product_model->get_all_category('dropdown');
        $this->data['types']        = $this->product_model->get_tax_discount_type('dropdown');
        $this->data['colors']       = $this->product_model->get_all_colors('dropdown');
        $this->data['sizes']        = $this->product_model->get_all_sizes('dropdown');
        $this->data['title']        = 'Product | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module']  = 'product';
        $this->data['view_file']    = 'create';
        $this->template->admin_ui($this->data);
    }

    public function ajax_show() {
        global $category, $subcategory;
        $status;
        $data           = array();
        $category_array = $this->product_model->get_all_category();
        $products       = $this->product_model->show();
        foreach ($products as $p_key => $product) {
            $sub_array = array();
            foreach ($category_array as $key => $cat) {
                if ($product->category_id == $cat->id) {
                    $category = $cat->category_name;
                }
            }
            foreach ($category_array as $key => $sub_cat) {
                if ($product->sub_category_id == $sub_cat->id) {
                    $sub_category = $sub_cat->category_name;
                }
            }

            if ($product->is_active == 1) {
                $is_active = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_product_status(' . $product->id . ',this)" checked="checked" class="onoffswitch-checkbox status" id="example' . $p_key . '" value="0">
                <label class="onoffswitch-label" for="example' . $p_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            } else if ($product->is_active == 0) {
                $is_active = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_product_status(' . $product->id . ',this)" class="onoffswitch-checkbox status" id="example' . $p_key . '" value="1">
                <label class="onoffswitch-label" for="example' . $p_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            }
            $sub_array[] = '<input type="checkbox" name="product_id[]" class="product_checkbox" value="' . $product->id . '"/>';
            $sub_array[] = '<img src="' . FILE_UPLOAD_PATH . '/' . $product->feature_picture . '" alt="product image" height="100px" width="100px;" onclick="view_image(this)">';
            $sub_array[] = $product->name;
            $sub_array[] = $product->quantity;
            $sub_array[] = ($product->quantity == 0) ? '<span class="label label-danger">Out of Stock</span>' : '<span class="label label-info">In Stock</span>';
            $sub_array[] = $product->purchase_price;
            $sub_array[] = $product->sale_price;
            $sub_array[] = $product->discount;
            $sub_array[] = $category;
            $sub_array[] = $sub_category;
            $sub_array[] = $is_active;
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" target="_blank" href="' . base_url('product/view?id=' . $product->id) . '">View</a></li>
            <li><a class="dropdown-item" href="' . base_url('product/edit/' . $product->id) . '">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_product(' . $product->id . ')">Delete</a></li>
            <li><a class="dropdown-item" data-toggle="modal" data-target="#add_discount" onclick="add_discount(' . $product->id . ')">Discount</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->product_model->count_total_row_of_product(),
            'recordsFiltered' => $this->product_model->count_total_row_of_product(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store() {

        if (isset($_POST) && isset($_FILES['product_feature_image']['name'])) {
            if ($this->product_model->duplicate_slug_check($this->input->post('slug', TRUE)) == false) {
                $config = image_config('products');
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('product_feature_image') == true) {
                    $data          = $this->upload->data();
                    $feature_image = 'products/' . $data['file_name'];
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
                $data = array(
                    'name'            => $this->input->post('name'),
                    'category_id'     => $this->input->post('category_id'),
                    'sub_category_id' => $this->input->post('sub_category_id'),
                    'purchase_price'  => $this->input->post('purchase_price'),
                    'sale_price'      => $this->input->post('sale_price'),
                    'discount'        => $this->input->post('discount'),
                    'discount_type'   => $this->input->post('discount_type'),
                    'tax'             => $this->input->post('tax'),
                    'color'           => ($this->input->post('color') != '') ? json_encode($this->input->post('color')) : NULL,
                    'size'            => ($this->input->post('size') != '') ? json_encode($this->input->post('size')) : NULL,
                    'description'     => $this->input->post('description'),
                    'feature_picture' => $feature_image,
                );
                $product_id = $this->product_model->store($data);

                if (!empty($_FILES['product_picture']['name'][0]) && isset($_FILES['product_picture']['name'][0]) && $product_id) {
                    if ($this->product_multiple_file_upload($_FILES, $config, $product_id) == true) {
                        response('product added', 200);
                    } else {
                        response('product not added', 200);
                    }
                }
            } else {
                response('porduct slug exist, it should be unique');
            }
        } else {
            response('submited');
        }
    }

    public function edit($product_id) {
        $this->data['product']          = $this->product_model->get_product($product_id);
        $this->data['product_pictures'] = $this->product_model->get_product_pictures($product_id);
        $this->data['categories']       = $this->product_model->get_all_category('dropdown');
        $this->data['types']            = $this->product_model->get_tax_discount_type('dropdown');
        $this->data['colors']           = $this->product_model->get_all_colors('dropdown');
        $this->data['sizes']            = $this->product_model->get_all_sizes('dropdown');
        $this->data['optional_images']  = $this->product_model->get_image_optional_image($product_id);
        $this->data['view_module']      = 'product';
        $this->data['view_file']        = 'edit';
        $this->data['title']            = 'Product | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function update() {
        $config = image_config('products');
        $this->load->library('upload', $config);
        $data = array();

        $product_id = $this->input->post('product_id');
        $product    = $this->product_model->get_product($product_id);
        if ($this->product_model->duplicate_slug_check($this->input->post('slug', TRUE), $product_id) == false) {
            if (!empty($_FILES['product_feature_image']['tmp_name'])) {
                $path = $product->feature_picture;
                if (!empty($path)) {
                    unlink('../uploads/' . $path);
                }
                if ($this->upload->do_upload('product_feature_image') == true) {
                    $image_data              = $this->upload->data();
                    $data['feature_picture'] = 'products/' . $image_data['file_name'];
                }
            }

            $data['slug']            = $this->input->post('slug', TRUE);
            $data['name']            = $this->input->post('name', TRUE);
            $data['category_id']     = $this->input->post('category_id', TRUE);
            $data['sub_category_id'] = $this->input->post('sub_category_id', TRUE);
            $data['purchase_price']  = $this->input->post('purchase_price', TRUE);
            $data['sale_price']      = $this->input->post('sale_price', TRUE);
            $data['discount']        = $this->input->post('discount', TRUE);
            $data['discount_type']   = $this->input->post('discount_type', TRUE);
            $data['tax']             = $this->input->post('tax', TRUE);
            $data['color']           = ($this->input->post('color') != '') ? json_encode($this->input->post('color', TRUE)) : NULL;
            $data['size']            = ($this->input->post('size') != '') ? json_encode($this->input->post('size', TRUE)) : NULL;
            $data['description']     = $this->input->post('description', TRUE);

            $updated = $this->product_model->update($product_id, $data);
            if ($updated == true) {
                if (!empty($_FILES['product_picture']['name'][0]) && isset($_FILES['product_picture']['name'][0]) && $product_id) {
                    if ($this->product_multiple_file_upload($_FILES, $config, $product_id) == true) {
                        response('product added', 200);
                    } else {
                        response('product not added', 200);
                    }
                }
            }
            response('succesfully updated', 200);
        } else {
            response('product slug exit, it should be uniqe');
        }
    }

    public function delete() {

        $product_id = $this->input->post('product_id');
        if (!is_array($product_id)) {
            if ($this->unlink_product_all_image($product_id) == true) {
                if ($this->product_model->delete($product_id) == true) {
                    response('product deleted', 200);
                } else {
                    response('failed to delete product');
                }
            }
        } else {
            if ($this->unlink_product_all_image($product_id) == true) {
                if ($this->product_model->delete($product_id) == true) {
                    response('product deleted', 200);
                } else {
                    response('failed to delete product');
                }
            }
        }
    }

    public function product_multiple_file_upload($files, $config, $product_id) {
        $file      = $_FILES;
        $file_size = count($_FILES['product_picture']['name']);
        $this->load->library('upload', $config);
        $data_array = array();
        for ($i = 0; $i < $file_size; $i++) {

            $_FILES['product_picture']['name']     = $file['product_picture']['name'][$i];
            $_FILES['product_picture']['type']     = $file['product_picture']['type'][$i];
            $_FILES['product_picture']['tmp_name'] = $file['product_picture']['tmp_name'][$i];
            $_FILES['product_picture']['error']    = $file['product_picture']['error'][$i];
            $_FILES['product_picture']['size']     = $file['product_picture']['size'][$i];

            if ($this->upload->do_upload('product_picture') == true) {
                $data         = $this->upload->data();
                $picture      = 'products/' . $data['file_name'];
                $data_array[] = ['product_id' => $product_id, 'picture' => $picture];
            }
        }
        if ($this->product_model->upload_multiple_image($data_array) == true) {
            return true;
        }
    }

    public function get_sub_category() {
        $category_id  = $this->input->post('category_id', TRUE);
        $sub_category = $this->product_model->get_sub_category($category_id);
        if (!empty($sub_category)) {
            echo json_encode($sub_category);
        } else {
            echo json_encode($sub_category);
        }
    }

    public function change_status() {
        $product_id = $this->input->post('product_id', TRUE);
        $status     = $this->input->post('status', TRUE);
        if ($this->product_model->change_status($product_id, $status) == true) {
            response('status changed', 200);
        } else {
            response('status not changed');
        }
    }

    public function view() {
        $id                            = $this->input->get('id', TRUE);
        $this->data['category']        = $this->product_model->get_all_category();
        $this->data['types']           = $this->product_model->get_tax_discount_type();
        $this->data['colors']          = $this->product_model->get_all_colors();
        $this->data['sizes']           = $this->product_model->get_all_sizes();
        $this->data['product']         = $this->product_model->get_product($id);
        $this->data['optional_images'] = $this->product_model->get_image_optional_image($id);
        $this->data['view_module']     = 'product';
        $this->data['view_file']       = 'view';
        $this->data['title']           = 'Product View| SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);

    }

    public function get_product_discount_by_id() {
        $product_id = $this->input->post('product_id', TRUE);
        $discount   = $this->product_model->get_product_discount_by_id($product_id);
        if (isset($discount)) {
            echo json_encode($discount);
        }
    }

    public function get_selected_discount_type() {
        $discount_type = $this->product_model->get_tax_discount_type();
        if (isset($discount_type)) {
            echo json_encode($discount_type);
        }
    }

    public function get_image_optional_image() {
        $product_id = $this->input->post('product_id', TRUE);
        if (isset($product_id)) {
            $images = $this->product_model->get_image_optional_image($product_id);
            if ($images) {
                $html = '';
                foreach ($images as $key => $image) {
                    $html .= '<div class="col-md-3 text-center">';
                    $html .= '<div class="form-group" style="border : 1px solid green;">';
                    $html .= '<label for="control-label mb-10">Optional Image &nbsp;&nbsp;';
                    $html .= '<span class="float-right text-danger" style="cursor:pointer" onclick="delete_single_image_optional(' . $image->id . ')">delete</span>';
                    $html .= '</label><br><br>';
                    $html .= '<img src="' . image_url($image->picture) . '" alt="default image" height="200px" width="100%" style="padding-bottom:6px;" , onclick="view_image(this)">';
                    $html .= '</div>';
                    $html .= '</div>';
                }
                echo $html;
            } else {
                echo '';
            }
        }
    }

    public function delete_single_image_optional() {
        $id = $this->input->post('id', TRUE);
        if (isset($id)) {
            if ($this->product_model->delete_single_image_optional($id) == true) {
                header("Content-type: application/json");
                echo json_encode(array('status' => 200));
                exit();
            } else {
                header("Content-type: application/json");
                echo json_encode(array('status' => 200));
                exit();
            }
        }
    }

    //// category functionality

    public function category() {
        $this->data['view_module'] = 'product';
        $this->data['view_file']   = 'category';
        $this->data['title']       = 'Product category | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function show_category() {
        $data       = array();
        $categories = $this->product_model->show_category();
        foreach ($categories as $c_key => $category) {
            $sub_array = array();
            $name      = "'" . $category->category_name . "'";
            if ($category->is_active == 1) {
                $status = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_category_status(' . $category->id . ',this)" checked="checked" class="onoffswitch-checkbox category_status" id="example' . $c_key . '" value="0">
                <label class="onoffswitch-label" for="example' . $c_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            } else if ($category->is_active == 0) {
                $status = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_category_status(' . $category->id . ',this)" class="onoffswitch-checkbox category_status" id="example' . $c_key . '" value="1">
                <label class="onoffswitch-label" for="example' . $c_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            }
            $sub_array[] = '<input type="checkbox" name="category_id[]" class="product_category_checkbox" value="' . $category->id . '"/>';
            $sub_array[] = $category->category_name;
            $sub_array[] = ($category->pid == 0) ? "Parent" : "Child";
            $sub_array[] = $status;
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" onclick="edit_product_category(' . $category->pid . ',' . $category->id . ',' . $name . ')" >Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_product_category(' . $category->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->product_model->count_total_row_of_category(),
            'recordsFiltered' => $this->product_model->count_total_row_of_category(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store_category() {
        $name   = $this->input->post('category_name', TRUE);
        $parent = $this->input->post('parent', TRUE);
        if ($this->product_model->store_category(['pid' => $parent, 'category_name' => $name]) == true) {
            response('category created', 200);
        }
    }

    public function update_category() {
        $name        = $this->input->post('category_name', TRUE);
        $parent      = $this->input->post('parent', TRUE);
        $category_id = $this->input->post('category_id', TRUE);
        if ($this->product_model->update_category(['pid' => $parent, 'category_name' => $name], $category_id) == true) {
            response('category created', 200);
        }
    }

    public function delete_products_category($product_category_id) {
        // $product_category_id = $this->input->post('product_category_id');
        if (!is_array($product_category_id)) {
            $this->unlink_product_image_related_to_category($product_category_id);
            $delete_product = $this->product_model->delete_product_category($product_category_id);
            $child_category = $this->product_model->get_sub_category_by_parent_category($product_category_id);
            if (!empty($child_category)) {
                $category_id = array();
                foreach ($child_category as $key => $value) {
                    $category_id[] = $value->id;
                }
                $this->delete_products_category($category_id);
            }
            if ($delete_product == true) {
                response('product category deleted', 200);
            } else {
                response('failed to delete product category', 200);
            }
        } else {
            foreach ($product_category_id as $key => $value) {
                $this->unlink_product_image_related_to_category($value);
                $delete_product = $this->product_model->delete_product_category($value);
            }
            $child_category = $this->product_model->get_sub_category_by_parent_category($product_category_id);
            if (!empty($child_category)) {
                $category_id = array();
                foreach ($child_category as $key => $value) {
                    $category_id[] = $value->id;
                }
                $this->delete_products_category($category_id);
            }
            if ($delete_product == true) {
                response('product deleted', 200);
            } else {
                response('failed to delete product', 200);
            }
        }
    }

    public function change_category_status() {
        $product_category_id = $this->input->post('products_category_id', TRUE);
        $status              = $this->input->post('status', TRUE);
        if ($this->product_model->change_category_status($product_category_id, $status) == true) {
            response('status changed', 200);
        } else {
            response('status not changed', 200);
        }
    }

    public function get_parent_category() {
        $category = $this->product_model->get_all_category();
        $html     = '';
        $html .= '<option value="0">Parent</option>';
        foreach ($category as $key => $value) {
            $html .= '<option value="' . $value->id . '">' . $value->category_name . '</option>';
        }

        echo $html;
    }

    public function get_selected_category() {
        $parent_id = $this->input->post('parent_id', TRUE);
        $category  = $this->product_model->get_all_category();
        $html      = '';
        $html .= '<option value="0">Parent</option>';
        foreach ($category as $key => $value) {
            if ($value->id == $parent_id) {
                $html .= '<option selected value="' . $value->id . '">' . $value->category_name . '</option>';
            } else {
                $html .= '<option value="' . $value->id . '">' . $value->category_name . '</option>';
            }
        }

        echo $html;

    }

    public function unlink_product_image_related_to_category($product_category_id) {
        if (!is_array($product_category_id)) {
            $product_image = $this->product_model->get_product_by_category_id($product_category_id);
            foreach ($product_image as $key => $value) {
                if ($value->feature_picture) {
                    @unlink('../uploads/' . $value->feature_picture);
                }
                $product_optional_image = $this->product_model->get_image_optional_image($value->id);
                if ($product_optional_image) {
                    foreach ($product_optional_image as $key => $optional) {
                        if ($optional->picture) {
                            @unlink('../uploads/' . $optional->picture);
                        }
                    }
                }
            }
            return true;
        } else {
            foreach ($product_category_id as $key => $id) {
                $product_image = $this->product_model->get_product_by_category_id($product_category_id);
                foreach ($product_image as $key => $value) {
                    if ($value->feature_picture) {
                        @unlink('../uploads/' . $value->feature_picture);
                    }
                    $product_optional_image = $this->product_model->get_image_optional_image($value->id);
                    if ($product_optional_image) {
                        foreach ($product_optional_image as $key => $optional) {
                            if ($optional->picture) {
                                unlink('../uploads/' . $optional->picture);
                            }
                        }
                    }
                }
            }
            return true;
        }
    }

    public function unlink_product_all_image($product_id) {
        if (!is_array($product_id)) {
            $product_image = $this->product_model->get_product($product_id);
            if ($product_image->feature_picture) {
                @unlink('../uploads/' . $value->feature_picture);
            }
            $product_optional_image = $this->product_model->get_image_optional_image($value->id);
            if ($product_optional_image) {
                foreach ($product_optional_image as $key => $optional) {
                    if ($optional->picture) {
                        @unlink('../uploads/' . $optional->picture);
                    }
                }
            }
            return true;
        } else {
            foreach ($product_id as $key => $id) {
                $product_image = $this->product_model->get_product($product_id);
                foreach ($product_image as $key => $value) {
                    if ($value->feature_picture) {
                        @unlink('../uploads/' . $value->feature_picture);
                    }
                    $product_optional_image = $this->product_model->get_image_optional_image($value->id);
                    if ($product_optional_image) {
                        foreach ($product_optional_image as $key => $optional) {
                            if ($optional->picture) {
                                unlink('../uploads/' . $optional->picture);
                            }
                        }
                    }
                }
            }
            return true;
        }
    }

}
