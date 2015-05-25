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
                $("#krit2").hide();
            }
            if (value==0){
                $("#test_icon").hide();
                $("#krit2").show();
            }
            if (value==1){
                $("#test_icon").hide();
                $("#krit2").show();
            }
            if (value==3){
                $("div#illnessModal").modal('show');
                $("#test_icon").show();
                $("#krit2").hide();
            }
        });
        //if($('#').exists()){
        //}
    });

    $(function() {

    });



})( jQuery );