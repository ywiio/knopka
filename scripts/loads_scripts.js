// function loadHomeContent() {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("dynamicContent").innerHTML = this.responseText;
//         }
//     };
//     xhttp.open("GET", "/partials/home/body.php", true);
//     xhttp.send();
// }

// function loadPetsContent() {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("dynamicContent").innerHTML = this.responseText;
//         }
//     };
//     xhttp.open("GET", "/partials/pets/body.php", true);
//     xhttp.send();
// }

// function loadAboutContent() {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("dynamicContent").innerHTML = this.responseText;
//         }
//     };
//     xhttp.open("GET", "/partials/about/body.php", true);
//     xhttp.send();
// }

// function loadNewsContent() {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("dynamicContent").innerHTML = this.responseText;
//         }
//     };
//     xhttp.open("GET", "/partials/news/body.php", true);
//     xhttp.send();
// }

// function loadContactsContent() {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("dynamicContent").innerHTML = this.responseText;
//         }
//     };
//     xhttp.open("GET", "/partials/contacts/body.php", true);
//     xhttp.send();
// }


function toggleCategories(str) {
    var categoryList = document.getElementById('categoryList');
    var genderList = document.getElementById('genderList');
    var sizeList = document.getElementById('sizeList');
    var woolList = document.getElementById('woolList');

    if (str=='category'){
        if (categoryList.style.display === 'none' || categoryList.style.display === '') {
            categoryList.style.display = 'flex';
        } else {
            categoryList.style.display = 'none';
        }
    }
    else if (str=='gender'){
        if (genderList.style.display === 'none' || genderList.style.display === '') {
            genderList.style.display = 'flex';
        } else {
            genderList.style.display = 'none';
        }
    }
    else if (str=='size'){
        if (sizeList.style.display === 'none' || sizeList.style.display === '') {
            sizeList.style.display = 'flex';
        } else {
            sizeList.style.display = 'none';
        }
    }
    else if (str=='wool'){
        if (woolList.style.display === 'none' || woolList.style.display === '') {
            woolList.style.display = 'flex';
        } else {
            woolList.style.display = 'none';
        }
    }
}

function loadAccBlock(str) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("info").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "load_block.php?div=" + str, true);
    xmlhttp.send();

    var div = document.getElementById("personal_data");
    div.style.backgroundColor = "rgba(188, 188, 188, 0)";
    var p = div.getElementsByTagName("p")[0];
    p.style.color = "#000000";
    var img = div.getElementsByTagName("img")[0];
    img.src = "/img/person_icon_bl.svg";
    
    var div = document.getElementById("subscribes");
    div.style.backgroundColor = "rgba(188, 188, 188, 0)";
    var p = div.getElementsByTagName("p")[0];
    p.style.color = "#000000";
    var img = div.getElementsByTagName("img")[0];
    img.src = "/img/dollar_icon_bl.svg";

    var div = document.getElementById("favorites");
    div.style.backgroundColor = "rgba(188, 188, 188, 0)";
    var p = div.getElementsByTagName("p")[0];
    p.style.color = "#000000";
    var img = div.getElementsByTagName("img")[0];
    img.src = "/img/heart_sticker_bl.svg";

    if(str=='personal_data'){
        var div = document.getElementById("personal_data");
        div.style.backgroundColor = "#BE2A2F";
        var p = div.getElementsByTagName("p")[0];
        p.style.color = "#FFFFFF";
        var img = div.getElementsByTagName("img")[0];
        img.src = "/img/person_icon.svg";
    }
    if(str=='subscribes'){
        var div = document.getElementById("subscribes");
        div.style.backgroundColor = "#BE2A2F";
        var p = div.getElementsByTagName("p")[0];
        p.style.color = "#FFFFFF";
        var img = div.getElementsByTagName("img")[0];
        img.src = "/img/dollar_icon.svg";
    }
    if(str=='favorites'){
        var div = document.getElementById("favorites");
        div.style.backgroundColor = "#BE2A2F";
        var p = div.getElementsByTagName("p")[0];
        p.style.color = "#FFFFFF";
        var img = div.getElementsByTagName("img")[0];
        img.src = "/img/like_icon.svg";
    }
    

}

function set_like(id_pet, id_user){ 
    $.ajax({ 
        type: 'POST', 
        url: '/partials/pets/likes.php', 
        data: ({ 
            id_pet : id_pet , 
            id_user: id_user
        }), 
        success: function(data){ 
            console.log("Поставил");
            $('.like').html('<img src="/img/heart_sticker_bl_full.svg" class="pet__info-block-like" onclick="del_like('+id_pet+','+id_user+')" ></img>'); 
            $(".pets__catalog-card-like-"+id_pet).html('<img src="/img/like_icon_full.svg" onclick="set_like('+id_pet+','+id_user+')" ></img>'); 
            $(".account__catalog-card-like-"+id_pet).html('<img src="/img/like_icon_full.svg" onclick="set_like('+id_pet+','+id_user+')" ></img>'); 
        } 
    }); 
}

function del_like(id_pet, id_user){
    $.ajax({ 
        type: 'POST', 
        url: '/partials/pets/likes.php', 
        data: ({ 
            id_pet_del : id_pet , 
            id_user_del: id_user
        }), 
        success: function(data){ 
            console.log("Убрал");
            $('.like').html('<img src="/img/heart_sticker_bl.svg" class="pet__info-block-like" onclick="set_like('+id_pet+','+id_user+')" ></img>'); 
            $(".pets__catalog-card-like-"+id_pet).html('<img src="/img/like_icon.svg" onclick="set_like('+id_pet+','+id_user+')" ></img>'); 
            $(".account__catalog-card-like-"+id_pet).html('<img src="/img/like_icon.svg" onclick="set_like('+id_pet+','+id_user+')" ></img>'); 
        } 
    }); 
}

