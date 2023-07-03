

   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   
   <!-- jquery cdn -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 
   <!-- Icon bootstrap -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

   <!-- Bootstrap core JavaScript-->
   <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
   <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

   <!-- Page level plugins -->
   <script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>
   
   <!-- Bootbox Bootstrap -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

   <!-- Page level custom scripts -->
   <!-- <script src="<?= base_url('assets/') ?>js/demo/chart-area-demo.js"></script>
   <script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script> --> 
   <script>
      function resetSearch() {
         $('input[name=searchText]').val("")
         $('#submit').click()
      }
      $('#orderList').on('change', function() {  
         $('#submit').click()
      }) 
   </script>

   <script>
      
      function ChangeUpper(elem) {
         return elem.value = elem.value.toUpperCase();
      }
      
      function ChangeLower(elem) {
         return elem.value = elem.value.toLowerCase();
      }
      
      function format(num) 
      {
         val = num.value;
         val = val.replace(/[^\d.]/g,"");
         arr = val.split('.');
         lftsde = arr[0];
         rghtsde = arr[1];
         result = "";
         lng = lftsde.length;
         j = 0;
         for (i = lng; i > 0; i--){
            j++;
            if (((j % 3) == 1) && (j != 1)){
               result = lftsde.substr(i-1,1) + "," + result;
            }else{
               result = lftsde.substr(i-1,1) + result;
            }
         }
         if(rghtsde==null){
            num.value = result;
         }else{
            num.value = result+'.'+arr[1];
         }
      } 

      function isNumberKeyDecimal(evt) 
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         // Added to allow decimal, period, or delete
         if (charCode == 110 || charCode == 190 || charCode == 46)
            return true;
         
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         
         return true;
      } 
   </script>