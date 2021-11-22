const form = document.querySelector('#message_box');
const fname = document.querySelector('#name');
const email = document.querySelector('#email');
const msg = document.querySelector('#msg');
const btn = document.querySelector('#submit_button');
const show = document.querySelector('#show');

form.addEventListener('submit', (e)=>{
const data = {
    name: fname.value,
    email: email.value,
    msg: msg.value
}
btn.classList.add('disabled');
show.textContent = "Please wait..."
ajax(JSON.stringify(data));
e.preventDefault();
});

function ajax(data){
    const xhr = new XMLHttpRequest();
    xhr.open("POST","sendmsg.php", true);
    xhr.onload = function(){
        if(xhr.status == 200){
            const data = JSON.parse(xhr.responseText);
            form.reset();
            btn.classList.remove('disabled');
            if(data.check == "success"){
                show.textContent = "Thanks for contacting us!"
            }
            else if(data.check == "Failed"){
                show.textContent = "An error occured.";
                show.classList.remove("text-success");
                show.classList.add("text-danger");
            }
        }else{
            alert("Error in sending request");
        }
    }
    xhr.send(data);
}