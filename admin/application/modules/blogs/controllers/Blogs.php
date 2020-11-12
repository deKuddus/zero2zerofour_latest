<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('blogs_model');
        $this->load->module('template');

    }

    public function index() {
        $this->data['view_module'] = 'blogs';
        $this->data['view_file']   = 'manage';
        $this->data['title']       = 'customer | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }
    /**
     *
     *@create() method used to create/insert
     *    blogs information
     *
     */
    public function create() {
        $this->data['category']    = $this->blogs_model->get_all_category('dropdown');
        $this->data['tags']        = $this->blogs_model->get_all_tags('dropdown');
        $this->data['view_module'] = 'blogs';
        $this->data['view_file']   = 'create';
        $this->data['title']       = 'customer | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }
    /*
     *
     * @show() method used to show blogs list
     *    list loaded by Datatable ajax
     *
     */
    public function show() {
        global $category, $sub_category;
        $data           = array();
        $category_array = $this->blogs_model->get_all_category();
        $tags_array     = $this->blogs_model->get_all_tags();
        $blogs          = $this->blogs_model->show();
        foreach ($blogs as $b_key => $blogs) {
            $sub_array = array();
            foreach ($category_array as $key => $cat) {
                if ($blogs->category == $cat->id) {
                    $category = $cat->name;
                }
            }
            foreach ($category_array as $key => $sub_cat) {
                if ($blogs->sub_category == $sub_cat->id) {
                    $sub_category = $sub_cat->name;
                }
            }
            $_tag = '';
            if ($blogs->tags != 'null') {
                foreach (json_decode($blogs->tags) as $key => $tag_value) {
                    foreach ($tags_array as $key => $tag) {
                        if ($tag_value == $tag->id) {
                            $_tag .= "<span class='label label-success'>" . $tag->name . "</span>&nbsp;";
                        }
                    }
                }
            }
            if ($blogs->is_active == 1) {
                $status = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_status(' . $blogs->id . ',this)" checked="checked" class="onoffswitch-checkbox status" id="example' . $b_key . '" value="0">
                <label class="onoffswitch-label" for="example' . $b_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            } else if ($blogs->is_active == 0) {
                $status = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_status(' . $blogs->id . ',this)" class="onoffswitch-checkbox status" id="example' . $b_key . '" value="1">
                <label class="onoffswitch-label" for="example' . $b_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            }
            $sub_array[] = '<input type="checkbox" name="blogs_id[]" class="blogs_checkbox" value="' . $blogs->id . '"/>';
            $sub_array[] = '<img src="' . FILE_UPLOAD_PATH . $blogs->images . '" alt="blogs image" height="100px" width="100px;" onclick="view_image(this)">';
            $sub_array[] = $blogs->title;
            $sub_array[] = textShort($blogs->content, 50);
            $sub_array[] = $blogs->slug;
            $sub_array[] = $blogs->author;
            $sub_array[] = $category;
            $sub_array[] = $sub_category;
            $sub_array[] = $_tag;
            $sub_array[] = $status;

            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" data-toggle="modal" data-target="#full_blog" onclick="view_blog(' . $blogs->id . ')" >View</a></li>
            <li><a class="dropdown-item" href="' . base_url('blogs/edit/' . $blogs->id) . '">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_blogs(' . $blogs->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->blogs_model->count_total_row_of_blog(),
            'recordsFiltered' => $this->blogs_model->count_total_row_of_blog(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    /*
     *
     * @store() function used to
     *    store blogs information
     *
     */
    public function store() {
        if ($this->blogs_model->check_blog_slug_duplicate($_POST['slug']) == false) {
            if (!empty($_FILES['blog_images']['name'])) {
                $config = image_config('blog_image');
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('blog_images') == true) {
                    $data  = $this->upload->data();
                    $image = 'blog_image/' . $data['file_name'];
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
            } else {
                response('upload a blog image');
            }
            $blog_data = [
                'title'        => $this->input->post('title', TRUE),
                'slug'         => clean_special_character($this->input->post('slug', TRUE)),
                'category'     => $this->input->post('category', TRUE),
                'sub_category' => $this->input->post('sub_category', TRUE),
                'author'       => $this->input->post('author', TRUE),
                'tags'         => json_encode($this->input->post('tags', TRUE)),
                'content'      => $this->input->post('content', TRUE),
                'images'       => $image,
            ];
            if ($this->blogs_model->store($blog_data) == true) {
                response('blog added', 200);
            }
        } else {
            response('slug already exist, it should be unique', 700);
        }
    }
    /*
     *
     *@edit() method used to edit a blogs
     *    by blogs id
     *
     */
    public function edit($blogs_id) {
        $this->data['blog']         = $this->blogs_model->get_blog($blogs_id);
        $this->data['category']     = $this->blogs_model->get_all_category('dropdown');
        $this->data['sub_category'] = $this->blogs_model->get_all_sub_category('dropdown');
        $this->data['tags']         = $this->blogs_model->get_all_tags('dropdown');
        $this->data['view_module']  = 'blogs';
        $this->data['view_file']    = 'edit';
        $this->data['title']        = 'customer | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    /*
     *
     *@update() method used to update
     *    blogs information after edit
     *
     */
    public function update() {
        if ($this->blogs_model->check_blog_slug_duplicate($_POST['slug'], $_POST['blog_id']) == false) {
            $blog_data = array();
            if (!empty($_FILES['blog_images']['name'])) {
                $config = image_config('blog_image');
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('blog_images') == true) {
                    $data  = $this->upload->data();
                    $image = 'blog_image/' . $data['file_name'];
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
                $file = $this->blogs_model->get_by_id($_POST['blog_id'])->images;
                if (unlink_file($file) == true) {
                    $blog_data['images'] = $image;
                }
            }

            $blog_data['title']        = $this->input->post('title', TRUE);
            $blog_data['slug']         = clean_special_character($this->input->post('slug', TRUE));
            $blog_data['category']     = $this->input->post('category', TRUE);
            $blog_data['sub_category'] = $this->input->post('sub_category', TRUE);
            $blog_data['author']       = $this->input->post('author', TRUE);
            $blog_data['tags']         = json_encode($this->input->post('tags', TRUE));
            $blog_data['content']      = $this->input->post('content', TRUE);

            if ($this->blogs_model->store($blog_data, $_POST['blog_id']) == true) {
                response('blog updated', 200);
            }
        } else {
            response('slug already exist,it should be unique', 700);
        }
    }

    /*
     * @delete() method has two type
     *    if multiple_delete parameter found the mulitiple data willbe
     *    deleted.
     *    else single data will be delted
     */
    public function delete() {

        $blogs_id = $this->input->post('blogs_id', TRUE);
        if (!is_array($blogs_id)) {
            if ($this->blogs_model->delete_blog_comments($blogs_id) == true) {
                $file = $this->blogs_model->get_by_id($blogs_id)->images;
                if ($file) {
                    @unlink('../uploads/' . $file);
                }
                if ($this->blogs_model->delete($blogs_id) == true) {
                    response('blog deleted', 200);
                } else {
                    response('failed to delete blogs');
                }
            }
        } else {
            foreach ($blogs_id as $key => $b_id) {
                if ($this->blogs_model->delete_blog_comments($b_id) == true) {
                    $file = $this->blogs_model->get_by_id($b_id)->images;
                    if ($file) {
                        @unlink('../uploads/' . $file);
                    }
                }
            }

            if ($this->blogs_model->delete($blogs_id) == true) {
                response('blogs deleted', 200);
            } else {
                response('failed to delete blogs', 200);
            }
        }
    }

    /*
     *
     * @get_sub_category() method to fetch subcategory for dropdown
     *    by category id
     *
     */
    public function get_sub_category() {
        $category_id  = $this->input->post('category_id', TRUE);
        $sub_category = $this->blogs_model->get_sub_category($category_id);
        if (!empty($sub_category)) {
            echo json_encode($sub_category);
        } else {
            echo json_encode($sub_category);
        }
    }

    /*
     *
     *@change_status() used to the blogs is active
     *    or not.(publish or not publish)
     *
     */
    public function change_status() {
        $blogs_id = $this->input->post('blogs_id', TRUE);
        $status   = $this->input->post('status', TRUE);
        if ($this->blogs_model->change_status($blogs_id, $status) == true) {
            response('status changed', 200);
        } else {
            response('status not changed', 200);
        }
    }

    /*
     *
     *@view() method used to see
     *    details of a blogs
     *
     */
    public function view_blog() {
        $id = $this->input->post('blog_id', TRUE);
        global $category, $sub_category;
        $category_array = $this->blogs_model->get_all_category();
        $tags_array     = $this->blogs_model->get_all_tags();
        $blog           = $this->blogs_model->get_by_id($id);

        foreach ($category_array as $key => $cat) {
            if ($blog->category == $cat->id) {
                $category = $cat->name;
            }
        }
        foreach ($category_array as $key => $sub_cat) {
            if ($blog->sub_category == $sub_cat->id) {
                $sub_category = $sub_cat->name;
            }
        }
        $_tag = '';
        foreach (json_decode($blog->tags) as $key => $tag_value) {
            foreach ($tags_array as $key => $tag) {
                if ($tag_value == $tag->id) {
                    $_tag .= "<span class='label label-success'>" . $tag->name . "</span>&nbsp;";
                }
            }
        }

        $html = '';
        $html .= ' <table id="blogs_list" class="table table-striped table-bordered table-hover" >';
        $html .= ' <tbody>';
        $html .= ' <tr><th>Title</th><td>' . $blog->title . '</td></tr>';
        $html .= ' <tr><th>Slug</th><td>' . $blog->slug . '</td></tr>';
        $html .= ' <tr><th>Category</th><td>' . $category . '</td></tr>';
        $html .= ' <tr><th>Sub Category</th><td>' . $sub_category . '</td></tr>';
        $html .= ' <tr><th>Tags</th><td>' . $_tag . '</td></tr>';
        $html .= ' <tr><th>Author</th><td>' . $blog->author . '</td></tr>';
        $html .= ' <tr><th>Image</th><td><img src="' . image_url($blog->images) . '" alt="blog image"></td></tr>';
        $html .= ' <tr><th>Content</th><td>' . $blog->content . '</td></tr>';
        $html .= ' </tbody>';
        $html .= ' </table>';

        echo $html;

    }

    //// category functionality

    public function category() {
        $this->data['view_module'] = 'blogs';
        $this->data['view_file']   = 'category';
        $this->data['title']       = 'customer | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function show_category() {
        $data       = array();
        $categories = $this->blogs_model->show_category();
        foreach ($categories as $c_key => $category) {
            $sub_array = array();
            $name      = "'" . $category->name . "'";
            if ($category->is_active == 1) {
                $status = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_status(' . $category->id . ',this)" checked="checked" class="onoffswitch-checkbox category_status" id="example' . $c_key . '" value="0">
                <label class="onoffswitch-label" for="example' . $c_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            } else if ($category->is_active == 0) {
                $status = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_status(' . $category->id . ',this)" class="onoffswitch-checkbox category_status" id="example' . $c_key . '" value="1">
                <label class="onoffswitch-label" for="example' . $c_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            }
            $sub_array[] = '<input type="checkbox" name="category_id[]" class="blog_category_checkbox" value="' . $category->id . '"/>';
            $sub_array[] = $category->name;
            $sub_array[] = ($category->pid == 0) ? "Parent" : "Child";
            $sub_array[] = $status;
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" onclick="edit_blog_category(' . $category->pid . ',' . $category->id . ',' . $name . ')" >Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_blogs_category(' . $category->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->blogs_model->count_total_row_of_category(),
            'recordsFiltered' => $this->blogs_model->count_total_row_of_category(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store_category() {
        $name   = $this->input->post('category_name', TRUE);
        $parent = $this->input->post('parent', TRUE);
        if ($this->blogs_model->store_category(['pid' => $parent, 'name' => $name]) == true) {
            response('category created', 200);
        }
    }

    public function update_category() {
        $name        = $this->input->post('category_name', TRUE);
        $parent      = $this->input->post('parent', TRUE);
        $category_id = $this->input->post('category_id', TRUE);
        if ($this->blogs_model->update_category(['pid' => $parent, 'name' => $name], $category_id) == true) {
            response('category created', 200);
        }
    }

    public function delete_blogs_category($blogs_category_id) {
        // $blogs_category_id = $this->input->post('blogs_category_id');
        if (!is_array($blogs_category_id)) {
            $this->unlink_blog_image_related_to_category($blogs_category_id);
            $delete_blogs   = $this->blogs_model->delete_blogs_category($blogs_category_id);
            $child_category = $this->blogs_model->get_sub_category_by_parent_category($blogs_category_id);
            if (!empty($child_category)) {
                $category_id = array();
                foreach ($child_category as $key => $value) {
                    $category_id[] = $value->id;
                }
                $this->delete_blogs_category($category_id);
            }
            if ($delete_blogs == true) {
                response('blog category deleted', 200);
            } else {
                response('failed to delete blogs category', 200);
            }
        } else {
            foreach ($blogs_category_id as $key => $value) {
                $this->unlink_blog_image_related_to_category($value);
                $delete_blogs = $this->blogs_model->delete_blogs_category($value);
            }
            $child_category = $this->blogs_model->get_sub_category_by_parent_category($blogs_category_id);
            if (!empty($child_category)) {
                $category_id = array();
                foreach ($child_category as $key => $value) {
                    $category_id[] = $value->id;
                }
                $this->delete_blogs_category($category_id);
            }
            if ($delete_blogs == true) {
                response('blogs deleted', 200);
            } else {
                response('failed to delete blogs', 200);
            }
        }
    }

    public function change_category_status() {
        $blogs_category_id = $this->input->post('blogs_category_id', TRUE);
        $status            = $this->input->post('status', TRUE);
        if ($this->blogs_model->change_category_status($blogs_category_id, $status) == true) {
            response('status changed', 200);
        } else {
            response('status not changed', 200);
        }
    }

    public function get_parent_category() {
        $category = $this->blogs_model->get_all_category();
        $html     = '';
        $html .= '<option value="0">Parent</option>';
        foreach ($category as $key => $value) {
            $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
        }
        echo $html;
    }

    public function get_selected_category() {
        $parent_id = $this->input->post('parent_id', TRUE);
        $category  = $this->blogs_model->get_all_category();
        $html      = '';
        $html .= '<option value="0">Parent</option>';
        foreach ($category as $key => $value) {
            if ($value->id == $parent_id) {
                $html .= '<option selected value="' . $value->id . '">' . $value->name . '</option>';
            } else {
                $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
            }
        }
        echo $html;
    }

    public function unlink_blog_image_related_to_category($blogs_category_id) {
        if (!is_array($blogs_category_id)) {
            $blog_image = $this->blogs_model->get_blog_by_category_id($blogs_category_id);
            foreach ($blog_image as $key => $value) {
                if ($value->images) {
                    @unlink('../uploads/' . $value->images);
                }
            }
            return true;
        } else {
            foreach ($blogs_category_id as $key => $id) {
                $blog_image = $this->blogs_model->get_blog_by_category_id($blogs_category_id);
                foreach ($blog_image as $key => $value) {
                    if ($value->images) {
                        unlink('../uploads/' . $value->images);
                    }
                }
            }
            return true;
        }
    }
}
