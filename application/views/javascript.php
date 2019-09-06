
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script src="<?php echo base_url() ?>assets/bootstrap/js/jquery.number.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });



</script>

<script type="text/javascript">

  $(document).ready(function($) {
    $("input[name='enable']").click(function(){
     if ($(this).is(':checked')) {
      $('input.textbox:text').attr("disabled", true);
       $('input.textbox2:text').attr("disabled", false);
    }
    else if ($(this).not(':checked')) {
        var remove = '';
        $('input.textbox:text').attr ('value', remove);
        $('input.textbox:text').attr("disabled", false);
         $('input.textbox2:text').attr("disabled", true);
      }
    }); 
  });

  </script>

  <script type="text/javascript">
    $(document).ready(function(){

    var counter = 2;

    $("#addButton").click(function () {

    var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
    var newTextBoxDiv2 = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
    var newTextBoxDiv3 = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
    var newTextBoxDiv4 = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
    var newTextBoxDiv5 = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
    var newTextBoxDiv6 = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);

    newTextBoxDiv.after().html("<table class='table table-bordered table-responsive'>"+"<tr><td>"+counter+"</td>"+"<td><textarea name='nm_pdk[]' class='form-control input-sm'></textarea></td><td><input type='number' id='jml_qty"+counter+"' name='jml_qty[]' placeholder='Jumlah' class='form-control input-sm' onchange='HitungPesanan()'></td><td><input type='text' id='harga"+counter+"'  name='harga[]' placeholder='Harga'  class='form-control input-sm input_uang' onchange='HitungPesanan()'></td><td><input type='text'id='total"+counter+"' name='total[]' placeholder='Total' class='form-control input-sm'  onchange='HitungPesanan()'></td>"+"</tr>");
    
    newTextBoxDiv.appendTo("#TextBoxesGroup");

    counter++;
     });

     $("#removeButton").click(function () {
    if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   

    counter--;

        $("#TextBoxDiv" + counter).remove();

     });
  });
  </script>


  <script type="text/javascript">
   var chk1=document.getElementById('chk_setuju');
   var getbox1=document.getElementById('box1');

   chk1.onclick=function(){
    console.log(this);
    if (this.checked) {
      getbox1.style['display']='block';

    }else{
      getbox1.style['display']='none';
    }

   };

  </script>
    <script type="text/javascript">
   var chk2=document.getElementById('chk_kirim');
   var getbox2=document.getElementById('box2');

   chk2.onclick=function(){
    console.log(this);
    if (this.checked) {
      getbox2.style['display']='block';

    }else{
      getbox2.style['display']='none';
    }
    
   };

  </script>
    <script type="text/javascript">
   var chk3=document.getElementById('chk_final');
   var getbox3=document.getElementById('box3');

   chk3.onclick=function(){
    console.log(this);
    if (this.checked) {
      getbox3.style['display']='block';

    }else{
      getbox3.style['display']='none';
    }
    
   };

  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.input_uang').number( true, 0 );

      $('#get_val').click(function(){
        $('#hasil_input').text($('#input_text').val());
      });
    });
  </script>


 <script type="text/javascript">
    $(document).ready(function(){
      var i;
        for(i=2; i<100; i++){
      }
      $('.input_uang'+i).number( true, 0 );

      $('#get_val').click(function(){
        $('#hasil_input').text($('#input_text').val());
      });
    });
  </script>

  <script type="text/javascript">
    function HitungPesanan() {
      var i;
      var ongkir =parseInt(document.getElementById('ongkir').value);
      var total=0;
      var subtotal=0;
        for(i=1; i<100; i++){



        var jlml_pcs =parseInt(document.getElementById('jml_qty'+i).value);
        var harga    =parseInt(document.getElementById('harga'+i).value);
        // var total    =parseInt(document.getElementById('total').value);

        var hitung = jlml_pcs*harga;

        if (hitung) {
            document.getElementById('total'+i).value=hitung;
            total +=hitung;
            
            var a=document.getElementById('jml_total').value=total;
            subtotal=a+ongkir;
            if (subtotal) {

              document.getElementById('SubTotal').value=subtotal;
            }
        }
      }

    }


  </script>
 