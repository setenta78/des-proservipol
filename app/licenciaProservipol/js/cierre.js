var micierre = false;
 
function ConfirmarCierre()
{
       if (event.clientY < 0)
       {
              event.returnValue = "";
              setTimeout(‘micierre = false’, 100);
              micierre = true;
       }
}
 
function ManejadorCierre()
{
        if (micierre == true)
        {
              document.location.href = "logout.php";
        }
}





