/*
	Author: Ahmed Ali | 101383139
	Purpose: contains the functions for each event with AJAX. 
*/
var xhr = false;

if (window.ActiveXObject) // if IE
{
    xhr = new ActiveXObject("Microsoft.XMLHTTP")
}
else if (window.XMLHttpRequest) // if firefox/chrome
{
    xhr = new XMLHttpRequest();
}

function registration()
{
    // get inputs

    var fname =  document.getElementById("fname").value;
    var lname =  document.getElementById("lname").value;
    var pwd =  document.getElementById("pwd").value;
    var db_pwd =  document.getElementById("db_pwd").value;
    var email =  document.getElementById("email").value;
    var phone =  document.getElementById("phone").value;

    xhr.open("GET","registration.php?" + "fname=" + encodeURIComponent(fname) + "&lname=" + encodeURIComponent(lname) + "&pwd=" + encodeURIComponent(pwd) + "&db_pwd=" + encodeURIComponent(db_pwd) + "&email=" + encodeURIComponent(email) + "&phone=" + encodeURIComponent(phone), true);

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var result = xhr.responseText;

            //alert(xhr.responseText);
            
            document.getElementById("message").innerHTML = result;
        }  
    }

    xhr.send(null);


}

function managerLogin()
{
    var id = document.getElementById("id").value;
    var pwd = document.getElementById("pwd").value;

    xhr.open("GET","mlogin.php?" + "id=" + encodeURIComponent(id) + "&pwd=" + encodeURIComponent(pwd), true);

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var result = xhr.responseText;

            //alert(xhr.responseText);

            document.getElementById("message").innerHTML = result;

            if (result == 200) // 200 means admin login successful
            {
                // remove the form 
                document.getElementById("mForm").innerHTML = "";

                document.getElementById("message").innerHTML = "You are now logged in!<br/><br />";
                document.getElementById("message").innerHTML += "Please select a link<br /><br />";
                document.getElementById("message").innerHTML += "<a href='listing.html'>Listing</a><br /><br />";
                document.getElementById("message").innerHTML += "<a href='processing.html'>Processing</a><br />";


                // Change header links
                document.getElementById("link1").innerHTML = "<a href='listing.html'>Listing</a>";
                document.getElementById("link2").innerHTML = "<a href='processing.html'>Processing</a>";
                document.getElementById("link3").innerHTML = "<a href='logout.html'>Log Out</a>";
            } 
        }
    }
    xhr.send(null);
}


function listItem()
{
    var itemName = document.getElementById("item_name").value;
    var itemPrice = document.getElementById("item_price").value;
    var qty = document.getElementById("qty").value;
    var itemDesc = document.getElementById("item_desc").value;

    xhr.open("GET","listing.php?" + "name=" + encodeURIComponent(itemName) + "&price=" + encodeURIComponent(itemPrice) + "&qty=" + encodeURIComponent(qty) + "&desc=" + encodeURIComponent(itemDesc), true);

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var result = xhr.responseText;

            //alert(xhr.responseText);

            document.getElementById("message").innerHTML = result;
        }
    }

    xhr.send(null);

}


function logOut()
{
    xhr.open("GET","logout.php", true);

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var result = xhr.responseText;

            //alert(xhr.responseText);

            document.getElementById("message").innerHTML = result;
        }
    }

    xhr.send(null);
}

function customerLogin()
{
    var email = document.getElementById("email").value;
    var pwd = document.getElementById("pwd").value;

    xhr.open("GET","login.php?" + "email=" + encodeURIComponent(email) + "&pwd=" + encodeURIComponent(pwd), true);

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var result = xhr.responseText;

            //alert(xhr.responseText);

            document.getElementById("message").innerHTML = result;

            if (result == 200) // 200 means customer login successful
            {
                // redirect to buying.html
                window.location.href = "buying.html";
            } 
        }
    }
    xhr.send(null);
   
}

function updateItems()
{
        xhr.open("GET","buying.php", true);

        xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 & xhr.status == 200)
            {
                var result = xhr.responseText;

                if (result == false) // if the session variable is empty send the user back to log in
                {
                    window.location.href = "login.html";
                }
                else
                {
                    document.getElementById("items").innerHTML = result;
                }
    
                
            }

        }
        xhr.send(null);
    
    setInterval(function() {   // calls the function every 10 seconds which refreshes the items.

        xhr.open("GET","buying.php", true);
 
        xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 & xhr.status == 200)
            {
                var result = xhr.responseText;
    
                document.getElementById("items").innerHTML = result;
            }

        }
        xhr.send(null);
    },10000);    
}


function addCart(id,qty)
{
     if (qty != 0)
     {
        xhr.open("GET","cart.php?" + "id=" + encodeURIComponent(id), true);

        xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 & xhr.status == 200)
            {
                var result = xhr.responseText;
    
                document.getElementById("cart").innerHTML = result;
            }

        }
        xhr.send(null);

     }

     else
     {
        document.getElementById("cart").innerHTML = "Sorry, this item is not available for sale." + " No stock";

        

     }
}


function removeItem(id)
{
    xhr.open("GET","remove.php?" + "id=" + encodeURIComponent(id), true);

    xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 & xhr.status == 200)
            {
                var result = xhr.responseText;
    
                document.getElementById("cart").innerHTML = result;
            }

        }
        xhr.send(null);

}

function cancel()
{
    xhr.open("GET","cancel.php", true);

    xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 & xhr.status == 200)
            {
                var result = xhr.responseText;
    
                document.getElementById("cart").innerHTML = result;
            }

        }
        xhr.send(null);

}

function confirmPurchase()
{
    xhr.open("GET","confirmPurchase.php", true);

    xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 & xhr.status == 200)
            {
                var result = xhr.responseText;

                //alert(xhr.responseText);
    
                document.getElementById("cart").innerHTML = result;
            }

        }
        xhr.send(null);

}

function customerLogOut()
{
    xhr.open("GET","c_logout.php", true);

    xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 & xhr.status == 200)
            {
                var result = xhr.responseText;

                if (result == false)
                {
                    window.location.href = "login.html";

                }

                else
                {
                    //alert(xhr.responseText);
                    document.getElementById("message").innerHTML = result;
                }
   
            }

        }
        xhr.send(null);

}

function processing()
{
    xhr.open("GET","processing.php", true);

        xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 & xhr.status == 200)
            {
                var result = xhr.responseText;

                if (result == false) // if the session variable is empty send the user back to log in
                {
                    window.location.href = "mlogin.html";
                }
                else
                {
                    document.getElementById("table").innerHTML = result;
                }
    
                
            }

        }
        xhr.send(null);

}

function clearSold()
{
    xhr.open("GET","clearSold.php", true);

        xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 & xhr.status == 200)
            {
                var result = xhr.responseText;

                document.getElementById("message").innerHTML = result;

                processing();
                 
            }

        }
        xhr.send(null);

}

