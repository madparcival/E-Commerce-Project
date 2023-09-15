

let deleteButtons=document.querySelectorAll('.deleteBtn')
  for(ele of deleteButtons){
    counter=0
    ele.addEventListener('click',function(){
        counter++
        this.setAttribute('class','btn btn-outline-success')
        this.innerText='Confirm'
        
        if(counter==2){
            deleteProduct(this.id)
            this.parentNode.parentNode.remove()
            counter=0
        }
    })
  }

function deleteProduct(id){
    console.log(id)
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){

      let mydiv=document.createElement('div')
      mydiv.setAttribute('class','alert alert-warning')
      mydiv.setAttribute('role','alert')
      let data=JSON.parse(this.responseText)
      mydiv.innerText=data['content']['Name']+' '+data['message']
      document.getElementsByClassName('messages')[0].appendChild(mydiv)
    }
    xhttp.open("DELETE", "http://localhost/phpprojects/Ecommerce/api/deleteProduct.php");
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(`{"id":${id}}`);
}

