
let allOrderBtn=document.getElementsByClassName('order')

for(ele of allOrderBtn){
    ele.addEventListener('click',function(){
        makeOrder(this.id,userId)
    })
}

function makeOrder(pid,cid){
    const xhr =new XMLHttpRequest()

    xhr.onload=function(){
        console.log(this.responseText)
    }

    xhr.open('POST','http://localhost/phpprojects/Ecommerce/api/placeOrder.php')
    xhr.setRequestHeader('Content-type','text/json')
    xhr.send(`{
        "cid":${cid},
        "pid":${pid}
    }`)
}