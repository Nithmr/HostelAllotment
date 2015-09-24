
          function parseScript(strcode) {
  var scripts = new Array();         // Array which will store the script's code
  
  // Strip out tags
  while(strcode.indexOf("<script") > -1 || strcode.indexOf("</script") > -1) {
    var s = strcode.indexOf("<script");
    var s_e = strcode.indexOf(">", s);
    var e = strcode.indexOf("</script", s);
    var e_e = strcode.indexOf(">", e);
    
    // Add to scripts array
    scripts.push(strcode.substring(s_e+1, e));
    // Strip from strcode
    strcode = strcode.substring(0, s) + strcode.substring(e_e+1);
  }
  
  // Loop through every script collected and eval it
  for(var i=0; i<scripts.length; i++) {
    try {
      eval(scripts[i]);
    }
    catch(ex) {
      // do what you want here when a script fails
    }
  }
}
          
          
          


            
            function rebin(keys)
            {
            
            
              
       
          array = keys.split(',');

          
          for(i=0;i<350;i++)
              {
               if(array[i]==undefined)
                  
                   array[i]=i;
              }
              
          document.writeln("helllo hi ");
     
                var options = {fillColor: '000000',
		mapKey: 'data-key',
		singleSelect:true,
                fillOpacity: 0.6,
		 areas:  [{
                         
                     key: array[0], 
                    staticState:true,
                    
		    fillOpacity: 5.6
                  },
            {
                    key: array[1], 
                    staticState:true,
                   
		    fillOpacity: 5.6
            },
            {
                    key: array[2], 
                    staticState:true,
                    
		    fillOpacity: 5.6
                  },
            {
                    key: array[3], 
                    staticState:true,
                   
		    fillOpacity: 5.6
            },
            {
                    key: array[4], 
                    staticState:true,
               
		    fillOpacity: 5.6
                  },
            {
                    key: array[5], 
                    staticState:true,
                   
		    fillOpacity: 5.6
            },
               {
                    key: array[6], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[7], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[8], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[9], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[10], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
            
             {
                    key: array[11], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[12], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[13], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[14], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[15], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[16], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[17], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[18], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[19], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[20], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[21], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[22], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[23], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[24], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[25], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[26], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[27], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[28], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[29], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[30], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[31], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[32], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[33], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[34], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[35], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
             {
                    key: array[36], 
                    staticState:true,
                    
		    fillOpacity: 5.6
            },
            
            
            
            
            
            
        
    ]};
                
             
                $('#Maping').mapster('unbind');
                $('#Maping').mapster(options);

                 
                 
                      
       
                 
                 
                 
                 
                 
                 
                 
           
             }
           
            









		