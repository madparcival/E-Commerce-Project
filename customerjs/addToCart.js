
let allAddToCartBtn=document.getElementsByClassName('addToCart')
const toastLiveExample = document.getElementById('liveToast')


for(ele of allAddToCartBtn){
    ele.addEventListener('click',function(){
        let quantity=this.previousElementSibling.value
        this.previousElementSibling.value=1
        if(quantity <=0){
            quantity=1
        }
        console.log(quantity)
        addToCart(this.id,userId,quantity)
        let myCartBtn=this
        myCartBtn.innerText='Added to cart'
        setTimeout(function(){
            myCartBtn.innerText='Add to cart'
        },500)

    })
}

function addToCart(pid,cid,quantity){
    const xhr =new XMLHttpRequest()
    xhr.open('POST','http://localhost/phpprojects/Ecommerce/api/addToCart.php')
    xhr.setRequestHeader('Content-type','text/json')
    xhr.send(`{
        "cid":${cid},
        "quantity":${quantity},
        "pid":${pid}
    }`)
    xhr.onload=function(){
        data=JSON.parse(this.responseText)
        toastLiveExample.lastElementChild.innerText=data['message']
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastBootstrap.show()
    }
}