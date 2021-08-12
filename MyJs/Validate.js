
function validate(){

    var error="";
    var name = document.getElementsByClassName( "name" );
    var letters = /^[A-Za-z]+$/;
    if( name.value === "" && name.value.match(letters))
    {
    error = " You Have To Write Your Name in alphabets only. ";
    document.getElementById( "name_err" ).innerHTML = error;
    return false;
    }
  
    var price=document.getElementsByClassName("price");
    if(price.value===""&& price.value<0)
    {
        error = " You Have To Write Your price. ";
        document.getElementById( "price_err" ).innerHTML = error;
        return false;
    }
    var category=document.getElementsByClassName("category_id");
    if(document.form.category.selectedIndex=="")
    {
        error = " You Have To Give choose one . ";
        document.getElementById( "category_err" ).innerHTML = error;
        return false
    }
    else{
        return true;
    }
   
}
