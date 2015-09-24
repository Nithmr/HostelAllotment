
$(document).ready(function() {
    //global vars
    
    
 $(document).ready(function() { 
		
            $('#photoimg').live('change', function()			{ 
			           $("#imageview").html('');
			    $("#imageview").html('<img  src="/hostel/app/webroot/img/loader.gif" height=20 width=120 alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#imageview'
		}).submit();
		
			});
        }); 
    
    var form = $("#myform");
    var flagn = 0; //for checking whether it is first time or not
    var flagg = 0;
    var flagp =0;
    var flagad= 0;
    var flagpl=0;
    var flagem=0;
    var flagcg=0;
    var flagmn=0;
    var flagfo=0;
    var flagmo=0;
    var flagfmo=0;
    var flagpi=0;
    var phone_number = $("#phone_number");
    var phone_numberinfo = $("#phone_numberinfo");
    var placename = $("#place_name");
    var placenameinfo = $("#placenameinfo");
    var name = $("#name");
    var nameinfo = $("#nameinfo");
    var guardian_name = $("#fathername");
    var guardian_nameinfo = $("#fathernameinfo");
    var address = $("#address");
    var addressinfo = $("#addressinfo");
    var form_date = $("#dob");
    var form_dateinfo = $("#form_dateinfo");    
    var email = $("#email");
    var emailinfo = $("#emailinfo");
    var cgpi = $("#cgpi");
    var cgpiinfo = $("#cgpiinfo");
     var mothername = $("#mothername");
    var mothernameinfo = $("#mothernameinfo");
     var fatheroccupation = $("#fatheroccupation");
    var fatheroccupationinfo = $("#fatheroccupationinfo");
     var motheroccupation = $("#motheroccupation");
    var motheroccupationinfo = $("#motheroccupationinfo");
     var fathermobileno = $("#fathermobileno");
    var fathermobilenoinfo = $("#fathermobilenoinfo");
    var pincode=$('#pincode');
    var pincodeinfo = $('#pincodeinfo');
    //On blur
    name.blur(validatename);
    
    guardian_name.blur(validateguardian_name);
    
    
    
    address.blur(validateaddress);
  

   email.blur(validateemail);
      
      cgpi.blur(validatecgpi);
       mothername.blur(validatemother_name);
       
      // fatheroccupation.blur(validatefatheroccupation);
      //  motheroccupation.blur(validatemotheroccupation);
         fathermobileno.blur(validatefathermobileno);
      
      
    $("#dob").Zebra_DatePicker(
    {
        view : 'years',
        dateFormat: 'yyyy-mm-dd',
        maxDate: '+10'
       
    }
    );

  
  //   form_date.blur(validateform_date);
  //  placename.blur(validateplacename);
    
   phone_number.blur(validatephone_number);

   pincode.blur(validatepincode);       
                 
            
        

                
                  



    //On key press
    //On Submitting
    form.submit(function(){
        flagg=1;
        flagn=1;
        flagp=1;
        flagad=1;
        flagpl=1;
        flagem=1;
        flagcg=1;
        flagmn=1;
        flagfo=1;
        flagmo=1;
        flagfmo=1;
        flagpi=1;
       // placename.keyup(validateplacename);
       //  guardian_name.keyup(validateguardian_name);
                    name.keyup(validatename);
                    address.keyup(validateaddress);
                  
                    email.keyup(validateemail);
                     cgpi.keyup(validatecgpi);
                     
                      mothername.keyup(validatemother_name);
                      pincode.keyup(validatepincode);
      // fatheroccupation.keyup(validatefatheroccupation);
      //  motheroccupation.keyup(validatemotheroccupation);
         fathermobileno.keyup(validatefathermobileno);
                     
                     
                  phone_number.keyup(validatephone_number);
        if( validatename() & validatepincode() &validatephone_number()  & validateaddress() &  validateguardian_name() & validateemail() & validatecgpi() & validatemother_name()  & validatefathermobileno() )
            return true
        else
            return false; 
    });
    function validateplacename(){
        //if it's NOT valid
           if(flagpl==0)
                        {
                             placename.keyup(validateplacename);
                        }
       flagpl=1;
        if(placename.val().length < 4){
            placename.addClass("error");
            placenameinfo.text("place names with more than 3 letters!");
            placenameinfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            placename.removeClass("error");
            placenameinfo.text("");
            placenameinfo.removeClass("error");
            return true;
        }
    }
    
    
    
    
    
    
    
    
                    
                      
    function checkEmail(str) {

    var e =str;
    var atpos =  e.indexOf("@");
    var dotpos= e.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=e.length)
  {
 
  return false;
  }
else
    return true;
}  




 function validateemail(){
        //if it's NOT valid
       if(flagem==0)
            email.keyup(validateemail);
       flagem=1;
        
        if(!checkEmail(email.val())){
           
            email.addClass("error");
            emailinfo.text(" invalid email");
            emailinfo.addClass("error");
            return false;
        }
        else{
            email.removeClass("error");
            emailinfo.text("");
            emailinfo.removeClass("error");
            return true;
        }
    }

    
    
    function validatecgpi()
    {
        var pattern = /^[0-9].[0-9][0-9]|10.00$/;
        
       if(flagcg==0)
            cgpi.keyup(validatecgpi);
       flagcg=1;
      
        if(!cgpi.val().match(pattern)){
           
            cgpi.addClass("error");
            cgpiinfo.text("cgpi should be in form X.XX");
            cgpiinfo.addClass("error");
           
            return false;
        }
        else{
           
            cgpi.removeClass("error");
            cgpiinfo.text("");
            cgpiinfo.removeClass("error");
          
            return true;
        }
    }
    
    
    
    
    
    
    function allletter(uname)  
        {   
        var letters = /^[A-Za-z ]+$/;  
        if(uname.match(letters))  
        {  
        return true;  
        }  
        else  
        {  
        return false;  
        }  
}  
    function validatename(){
        //if it's NOT valid
       if(flagn==0)
            name.keyup(validatename);
       flagn=1;
        
        if(!allletter(name.val())){
            name.addClass("error");
            nameinfo.text(" should contain only characters [A-Z a-z]");
            nameinfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            name.removeClass("error");
            nameinfo.text("");
            nameinfo.removeClass("error");
            return true;
        }
    }
	
    function validateguardian_name(){
        //if it's NOT valid
       
       if(flagg==0)
                    {
                        guardian_name.keyup(validateguardian_name);
                    }
       flagg=1;
       
       
        
        if(!allletter(guardian_name.val())){
            guardian_name.addClass("error");
            guardian_nameinfo.text("should contain only characters [A-Z a-z] ");
            guardian_nameinfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            guardian_name.removeClass("error");
            guardian_nameinfo.text("");
            guardian_nameinfo.removeClass("error");
            return true;
        }
    }
    
      function validatemother_name(){
        //if it's NOT valid
       
       if(flagmn==0)
                    {
                        mothername.keyup(validatemother_name);
                    }
       flagmn=1;
       
       
        
        if(!allletter(mothername.val())){
            mothername.addClass("error");
            mothernameinfo.text("should contain only characters [A-Z a-z] ");
            mothernameinfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            mothername.removeClass("error");
            mothernameinfo.text("");
            mothernameinfo.removeClass("error");
            return true;
        }
    }
	
         function validatemotheroccupation(){
        //if it's NOT valid
       
       if(flagmo==0)
                    {
                        motheroccupation.keyup(validatemotheroccupation);
                    }
       flagmo=1;
       
       
        
        if(!allletter(motheroccupation.val())){
            motheroccupation.addClass("error");
            motheroccupationinfo.text("should contain only characters [A-Z a-z] ");
            motheroccupationinfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            motheroccupation.removeClass("error");
            motheroccupationinfo.text("");
            motheroccupationinfo.removeClass("error");
            return true;
        }
    }


          function validatefatheroccupation(){
        //if it's NOT valid
       
       if(flagfo==0)
                    {
                        fatheroccupation.keyup(validatefatheroccupation);
                    }
       flagfo=1;
       
       
        
        if(!allletter(fatheroccupation.val())){
            fatheroccupation.addClass("error");
            fatheroccupationinfo.text("should contain only characters [A-Z a-z] ");
            fatheroccupationinfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            fatheroccupation.removeClass("error");
            fatheroccupationinfo.text("");
            fatheroccupationinfo.removeClass("error");
            return true;
        }
    }
    function validateaddress(){
        //if it's NOT valid
      if(flagad==0)
                    {
                         address.keyup(validateaddress);
                    }
      
      flagad=1;
        if(address.val().length < 4){
            address.addClass("error");
            addressinfo.text("Address more than 3 letters!");
            addressinfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            address.removeClass("error");
            addressinfo.text("");
            addressinfo.removeClass("error");
            return true;
        }
    }
	
    function validateform_date(){
        var input = form_date.val();
        var validformat=/^(\d{2})[-\/](\d{2})[-\/](\d{4})$/ //Basic check for format validity
        if (!validformat.test(input))
        {
            form_date.addClass("error");
            form_dateinfo.text("date should be in dd-mm-yyyy format");
            form_dateinfo.addClass("error");
            return false;
        }
        else{ //Detailed check for valid date ranges
            var monthfield=input.split("-")[1]
            var dayfield=input.split("-")[0]
            var yearfield=input.split("-")[2]
            var dayobj = new Date(yearfield, monthfield-1, dayfield)
            if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield)) {
                form_date.addClass("error");
                form_dateinfo.text("date should be in dd-mm-yyyy format");
                form_dateinfo.addClass("error");
                return false;
            } else {
                form_date.removeClass("error");
                form_dateinfo.text("");
                form_dateinfo.removeClass("error");
                return true;
            }
        }
    }
	
    function validatephone_number(){
        //if it's NOT valid
        
        if(flagp==0)
                phone_number.keyup(validatephone_number);
      flagp=1;
        var a = $("#phone_number").val();
		
        var pattern = /^\d{10}$/;
        if (!pattern.test(a)) {
            phone_number.addClass("error");
            phone_numberinfo.text("mobile number should be 10 numeric digits");
            phone_numberinfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            phone_number.removeClass("error");
            phone_numberinfo.text("");
            phone_numberinfo.removeClass("error");
            return true;
        }
    }
   
    function validatepincode(){
        //if it's NOT valid
        

        if(flagpi==0)
                pincode.keyup(validatepincode);
      flagpi=1;
        var a = $("#pincode").val();
		
        var pattern = /^\d{6}$/;
        if (!pattern.test(a)) {
            pincode.addClass("error");
            pincodeinfo.text("pincode should be 6 numeric digits");
            pincodeinfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            pincode.removeClass("error");
            pincodeinfo.text("");
            pincodeinfo.removeClass("error");
            return true;
        }
    }
   
   
    function validatefathermobileno(){
        //if it's NOT valid
        if(flagfmo==0)
                fathermobileno.keyup(validatefathermobileno);
      flagfmo=1;
        var a = $("#fathermobileno").val();
		
        var pattern = /^\d{10}$/;
        if (!pattern.test(a)) {
            fathermobileno.addClass("error");
            fathermobilenoinfo.text("mobile number should be 10 numeric digits");
            fathermobilenoinfo.addClass("error");
            return false;
        }
        //if it's valid
        else{
            fathermobileno.removeClass("error");
            fathermobilenoinfo.text("");
            fathermobilenoinfo.removeClass("error");
            return true;
        }
    }
   
});


