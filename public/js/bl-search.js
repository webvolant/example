/**
 * Created by barkalovlab on 12.05.15.
 */

(function( $ ){

    /*
    jQuery.fn.exists = function() {
        return jQuery(this).length;
    }
*/
    $(function() {
        $("select#krit1").change(function(){
            var value = $("select#krit1 option:selected").val();
            if (value==2){
                $("div#testsModal").modal('show');
                $("#test_icon").show();
            }
        });
        //if($('#').exists()){
        //}
    });

    $(function() {

    });



})( jQuery );