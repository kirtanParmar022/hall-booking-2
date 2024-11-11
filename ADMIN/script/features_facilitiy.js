
let features_s_form=document.getElementById('features_s_form');
let facility_s_form=document.getElementById('facility_s_form');

features_s_form.addEventListener('submit',function(e){
      e.preventDefault();
      add_features();
    });

    function add_features()
    {
      let data = new FormData();
      data.append('name',features_s_form.elements['feature_name'].value);
      
      data.append('add_features','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facility.php",true);
  

     xhr.onload =function(){
     console.log(this.responseText);
      var myModal =document.getElementById('features-s');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

     if(this.responseText==1){
      alert('success','New features added!');
      features_s_form.elements['feature_name'].value='';
      get_features();
     }
      else {
        alert('error','server Down!');
      }
     }
     xhr.send(data);
    }
    function get_features()
    {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facility.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
     document.getElementById('features-data').innerHTML=this.responseText;
    }

    xhr.send('get_features');
    }

    function  rem_feature(val)
    {
      let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facility.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
      console.log(this.responseText);
      if(this.responseText==1){
          alert('success','feature removed!');
          get_features();
        }
        else if(this.responseText=='hall_added'){
          alert('error','feature is  added in hall!');
        }
        else
        {
           alert('error','server down!');
        }
      
    }

    xhr.send('rem_feature='+val);
    }
   
    facility_s_form.addEventListener('submit',function(e){
      e.preventDefault();
      add_facility();
    });

    function add_facility()
    {
      let data = new FormData();
      
      data.append('name',facility_s_form.elements['facility_name'].value);
      data.append('icon',facility_s_form.elements['facility_icon'].files[0]);
      data.append('desc',facility_s_form.elements['facility_desc'].value);
      data.append('add_facility','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facility.php",true);
  

     xhr.onload =function(){
     console.log(this.responseText);
      var myModal =document.getElementById('facility-s');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      if(this.responseText=='inv_img'){
      alert('error','Only SVG images are allowed!');
     }
     else if(this.responseText=='inv_size'){
      alert('error','Image should be less than 1 MB!');
    }
     else if(this.responseText=='upd_failed'){
      alert('error','image upload failed. server down!')
     }
     else{
      alert('success','New facility added!');
      facility_s_form.reset();
      get_facilitys();
     }
     }
     xhr.send(data);
    }
   
    function get_facilitys()
    {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facility.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
     document.getElementById('facilitys-data').innerHTML=this.responseText;
    }

    xhr.send('get_facilitys');
    }
   
    function  rem_facility(val)
    {
      let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facility.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
      if(this.responseText==1){
          alert('success','facility removed!');
          get_facilitys();
        }
        else if(this.responseText=='hall_added'){
          alert('error','fecility is  added in hall!');
        }
        else
        {
           alert('error','server down!');
        }
      
    }

    xhr.send('rem_facility='+val);
    }
   
    window.onload=function(){
      get_features();
      get_facilitys();
    }

    
