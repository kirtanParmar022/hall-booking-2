

  

      function get_bookings(search=''){
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/new_bookings.php",true);
      xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

      xhr.onload =function(){
      document.getElementById('table-data').innerHTML=this.responseText;
      }
      xhr.send('get_bookings&search='+search);
      }

      

     
      
      function assign_hall(id)
      {
        
        
          let data = new FormData();
          data.append('booking_id',id);
          data.append('assign_hall','');

          let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/new_bookings.php",true);
         


          xhr.onload =function(){
          if(this.responseText==1){
          alert('success','Booking successfull!');
          get_bookings();
          }
          else{
          alert('error','server Down!');
          }
          }
          xhr.send(data);
          
        }


      function cancel_booking(id)
      {
        if(confirm("Are you sure, you want to cancel this booking?"))
        {
          let data = new FormData();
          data.append('booking_id',id);
          data.append('cancel_booking','');

          let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/new_bookings.php",true);
        


          xhr.onload =function(){
          if(this.responseText==1){
          alert('success','Booking cancelled!');
          get_bookings();
          }
          else{
          alert('error','server Down!');
          }
          }
          xhr.send(data);
          }
        }






    
        
      
      window.onload=function(){
        get_bookings();
      }

