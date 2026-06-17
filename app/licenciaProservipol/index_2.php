<html>
<head>
<script type="text/javascript">

var arreglofinal 	= new Array();
function llenaArreglo(){
	var arreglo  = new Array();     
	var arreglo1 = new Array();     
	var arreglo2 = new Array(); 
	var arreglo3 = new Array();  
	
	arreglo1[0] = "CF1";
	arreglo1[1] = "CF2";
	arreglo1[2] = "CF3";
		
	arreglo2[0] = "CUAD1";
	arreglo2[1] = "CUAD2";
	
	
	arreglo3[0] = "DF1"; 
	arreglo3[1] = "DF2"; 
	arreglo3[2] = "DF3"; 

	
	arreglo[0] = "1";
	arreglo[1] = "VEH";     
	arreglo[2] = "KM_INICIAL";     
	arreglo[3] = "KM_FINAL";     
	arreglo[4] = arreglo1;
	arreglo[5] = arreglo2; 
	arreglo[6] = arreglo3; 
	
	arreglofinal[0]=arreglo;
	arreglofinal[1]=arreglo;
}


//alert(arreglofinal[0][1] instanceof Array);

function php_serialize(obj)
{
    var string = '';

    if (typeof(obj) == 'object') {
        if (obj instanceof Array) {
            string = 'a:';
            tmpstring = '';
            var count = 0;
            //for (var key in obj) {
            //    tmpstring += php_serialize(key);
            //    tmpstring += php_serialize(obj[key]);
            //    count++;
            //}
            //count = obj.length; 
            //alert(count);
            for (var key=0; key<obj.length; key++) {
                tmpstring += php_serialize(key);
                tmpstring += php_serialize(obj[key]);
                count++;
            }
            
            string += count + ':{';
            string += tmpstring;
            string += '}';
        } else if (obj instanceof Object) {
            classname = obj.toString();

            if (classname == '[object Object]') {
                classname = 'StdClass';
            }

            string = 'O:' + classname.length + ':"' + classname + '":';
            tmpstring = '';
            count = 0;
            for (var key in obj) {
                tmpstring += php_serialize(key);
                if (obj[key]) {
                    tmpstring += php_serialize(obj[key]);
                } else {
                    tmpstring += php_serialize('');
                }
                count++;
            }
            string += count + ':{' + tmpstring + '}';
        }
    } else {
        switch (typeof(obj)) {
            case 'number':
                if (obj - Math.floor(obj) != 0) {
                    string += 'd:' + obj + ';';
                } else {
                    string += 'i:' + obj + ';';
                }
                break;
            case 'string':
                string += 's:' + obj.length + ':"' + obj + '";';
                break;
            case 'boolean':
                if (obj) {
                    string += 'b:1;';
                } else {
                    string += 'b:0;';
                }
                break;
        }
    }

    return string;
}

llenaArreglo();
document.write(php_serialize(arreglofinal) + "<br />");

alert("acabado el ejemplo");

</script>

</body>
</html>