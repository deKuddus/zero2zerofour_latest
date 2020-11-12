function loadjsfile(filename, filetype) {    
    if (filetype == "js") {        
        var fileref = document.createElement('script')        
        fileref.setAttribute("type", "text/javascript")        
        fileref.setAttribute("src", base_url + 'public/custom_js/' + filename + '.js')    
    }    
    if (typeof fileref != "undefined") {        
        document.getElementsByTagName("head")[0].appendChild(fileref);
    }
}
loadjsfile("helper", "js"); 
var site = url.split("/");
if (site.includes("auth")) {
    loadjsfile("auth", "js");
}
if (site.includes("events")) {
    loadjsfile("events", "js");
}
if (site.includes("projects")) {
    loadjsfile("projects", "js");
}
if (site.includes("customers")) {
    loadjsfile("customers", "js");
}
if (site.includes("event_categories")) {
    loadjsfile("event_categories", "js");
}
if (site.includes("product")) {
    loadjsfile("product", "js");
}
if (site.includes("blogs")) {
    loadjsfile("blogs", "js");
}
if (site.includes("dashboard")) {
    loadjsfile("dashboard", "js");
}
if (site.includes("causes")) {
    loadjsfile("causes", "js");
}
if (site.includes("terms")) {
    loadjsfile("terms", "js");
}
if (site.includes("privacy")) {
    loadjsfile("privacy", "js");
}
if (site.includes("slider")) {
    loadjsfile("slider", "js");
}
if (site.includes("setting")) {
    loadjsfile("config", "js");
}
if (site.includes("logo")) {
    loadjsfile("logo", "js");
}
if (site.includes("orders")) {
    loadjsfile("orders", "js");
}
if (site.includes("about_us") || site.includes("about_us_edit")) {
    loadjsfile("about_us", "js");
}
if (site.includes("history") || site.includes("history_edit")) {
    loadjsfile("history", "js");
}
if (site.includes("mission")) {
    loadjsfile("mission", "js");
}
if (site.includes("volunteers")) {
    loadjsfile("volunteers", "js");
}
if (site.includes("members")) {
    loadjsfile("members", "js");
}
if (site.includes("desclaimer")) {
    loadjsfile("desclaimer", "js");
}
if (site.includes("faq")) {
    loadjsfile("faq", "js");
}
if (site.includes("header_image")) {
    loadjsfile("header_image", "js");
}
if (site.includes("donors")) {
    loadjsfile("donors", "js");
}