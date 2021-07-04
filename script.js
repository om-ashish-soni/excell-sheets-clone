var dropdown_click=0;
function save_form(){
    document.getElementById('save_as').style.display="block";
}
function new_form(){
    document.getElementById('new_form').submit();
}
function login(){
    document.getElementById('login').style.display="block";
    document.getElementById('signin').style.display="none";

}
function signin(){
    document.getElementById('login').style.display="none";
    document.getElementById('signin').style.display="block";

}
function dropdown() {
    dropdown_click++;

    if(dropdown_click%2==0){
        document.getElementById("dropdown").style.display="none";      
    }
    else{
        document.getElementById("dropdown").style.display="block";
        
    }

}