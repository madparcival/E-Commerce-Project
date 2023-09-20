
let allAddToCartBtn=document.getElementsByClassName('addToCart')

for(ele of allAddToCartBtn){
    ele.addEventListener('click',function(){
        addToCart(this.id,userId)
        let myCartBtn=this
        myCartBtn.innerText='Added to cart'
        setTimeout(function(){
            myCartBtn.innerText='Add to cart'
        },500)

    })
}

function addToCart(pid,cid){
    const xhr =new XMLHttpRequest()
    xhr.open('POST','http://localhost/phpprojects/Ecommerce/api/addToCart.php')
    xhr.setRequestHeader('Content-type','text/json')
    xhr.send(`{
        "cid":${cid},
        "pid":${pid}
    }`)
    xhr.onload=function(){
        data=JSON.parse(this.responseText)
    }
}