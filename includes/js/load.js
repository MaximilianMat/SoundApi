
include('includes/js/jquery.min.js');
include('includes/js/app.js');

function include(path){
    document.write('<script type="text/javascript" src="'+ path + '"></script>');
    return false;
}