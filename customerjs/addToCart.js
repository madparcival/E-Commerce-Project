
let allAddToCartBtn=document.getElementsByClassName('addToCart')

for(ele of allAddToCartBtn){
    ele.addEventListener('click',function(){
        addToCart(this.id,userId)
    })
}

function addToCart(pid,cid){
    const xhr =new XMLHttpRequest()

    xhr.onload=function(){
        console.log(this.responseText)
    }

    xhr.open('POST','http://localhost/phpprojects/Ecommerce/api/addToCart.php')
    xhr.setRequestHeader('Content-type','text/json')
    xhr.send(`{
        "cid":${cid},
        "pid":${pid}
    }`)
}