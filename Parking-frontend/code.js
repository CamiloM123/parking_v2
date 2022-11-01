/* Here comes the Javascript code */

// Update the REST API server's URL
const url = "http://192.168.119.30:8000/api/v1/";

// List of records loaded from API REST
var records = [];

// Login modal dialog
const loginDialog = new bootstrap.Modal('#login-dialog', {
    focus: true
});

/**
 * Execute as soon as the page is completely loaded.
 */

window.onload = function () {
    // Set the listeners for the page's buttons

    const bLogin = document.getElementById("bLogin");
    const bLoginAccept = document.getElementById("blogin-accept");
    const bAdd = document.getElementById("bAdd");
    const bClear = document.getElementById("bClear");
    const bDelete = document.getElementById("bDelete");
    const bReload = document.getElementById("bReload");

    bLogin.addEventListener("click", handleLogin);
    bLoginAccept.addEventListener("click", handleLogin);
    bAdd.addEventListener("click", addRecord);
    bClear.addEventListener("click", clearForm);
    bDelete.addEventListener("click", deleteRecord);
    bReload.addEventListener("click", reloadList);
};

/**
 * Clear the fields of the product's form.
 */

function clearForm() {
    // Here comes the code ...
}

/**
 * Handle the login/logout magic: 
 * 
 *  - Show the login dialog
 *  - Call the login procedure
 *  - Call the logout procedure
 * 
 * @param {*} event 
 */

function handleLogin(event) {
    var flag = event.target.innerText;

    if (flag == "Login") {  // Show the login dialog
        loginDialog.show();
    } else if (flag == "Accept") {  // Login the user (get new token)
        login();
        document.getElementById("bLogin").innerText = "Logout";
        loginDialog.hide();
    } else if (flag == "Logout") {  // Logout the user (release token)
        logout();
        document.getElementById("bLogin").innerText = "Login";
    } else {    // Error, the flag has unknown value
        alert("ERROR: flag type unknown: " + flag);
    }
}

/**
 * Login the user.
 */

 async function login() {
    // Here comes the code ...
    var valorEmail = document.getElementById("login_email").value;
    var valorPassword = document.getElementById("login_password").value;

    const params = {
        email : valorEmail,
        password : valorPassword
    };

    const response = await fetch(url + "login", {
        method : "POST",
        headers : {
            'Content-Type' : 'application/json',
            'Accept' : 'application/json'
        },
        body : JSON.stringify(params)
    });

    const answer = await response.json();
    if (response.status == 200)
    {
        var token = answer.token;
        localStorage.setItem('token', token);
        console.log("ok");
    }
    else
    {
        alert("Error logging : " + response.statusText);
    }
    
}

/**
 * Logout the user.
 */

 async function logout() {
    // Here comes the code ...
    const response = await fetch(url + "logout", {
        method : "POST",
        headers : {
            'Content-Type' : 'application/json',
            'Accept' : 'application/json',
            'Authorization' : 'Bearer' + localStorage.getItem('token')
        },
        
    });

    if(response.status == 200)
    {
        localStorage.removeItem('token');
        console.log("Ok");
    }
    else
    {
        alert("Error logging out: " + response.statusText);
    }
}

/**
 * Create a new parking_place.
 */

 async function addRecord() {
    // Here comes the code ...
    valorRow = document.getElementById("row");
    valorColumn = document.getElementById("column");
    valorParkingId = document.getElementById("parking_id");

    const params = {
        row:valorRow,
        column:valorColumn,
    };

    const response = await fetch(url + "parkings/" + valorParkingId + "/parking_places", {
        method : "POST",
        headers : {
            'Content-Type' : 'application/json',
            'Accept' : 'application/json',
            'Authorization' : 'Bearer' + localStorage.getItem('token')
        },
        body: JSON.stringify(params)
    })

    console.log("Se creo el registro");
}

/**
 * Load the list of parking_places.
 */

 async function reloadList() {
    // Here comes the code ...
    valorParking_id = document.getElementById("parking_id");
    const response = await fetch(url + "parking/" + valorParking_id + "/parking_places", {
        method : "GET",
        headers : {
            'Content-Type' : 'application/json',
            'Accept' : 'application/json',
            'Authorization' : 'Bearer' + localStorage.getItem('token')
        },
        body: JSON.stringify(params)
    })

    var tableBody = document.getElementById("product-list")
    records = answer.data;
    tableBody.innerHTML = "";

    records.forEach(function (item, index) {
        var id = item.id;
        var name = item.name;
        var price = item.price;
        var expiration = item.expiration;

        var newRow = tableBody.insertRow(tableBody.rows.length)
    })

}

/**
 * Load the data of a product.
 * 
 * @param {*} id 
 */

function loadListItem(id) {
    // Here comes the code ...
}

/**
 * Delete a product.
 */

async function deleteRecord() {
    // Here comes the code ...
}

