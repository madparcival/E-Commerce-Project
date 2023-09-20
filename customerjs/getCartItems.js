
let cartButton=document.getElementById('cartBtn')
cartButton.addEventListener('click',function(){
    getCartElements(userId)
})

function getCartElements(cid){
    const xhr =new XMLHttpRequest()
    xhr.open('POST','http://localhost/phpprojects/Ecommerce/api/getCartProducts.php')
    xhr.setRequestHeader('Content-type','text/json')
    xhr.send(`{
        "cid":${cid}
    }`)
    xhr.onload=function(){
        let cart=document.getElementById('cartDiv')
        let tempDiv='<div>'
        data=JSON.parse(this.responseText)

        for(ele of data['message']){
            tempDiv+=`<div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="files/${ele['imagepath']}" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">${ele['Name']}</h5>
                  <p class="card-text">₹${ele['Amount']}</p>
                  <p class="card-text">Quantity: ${ele['Quantity']} Nos.</p>
                </div>
              </div>
            </div>
          </div>`
        }
        tempDiv+='</div>'
        cart.innerHTML=tempDiv
    }
}