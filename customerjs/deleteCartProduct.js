function addDeleteFunctionality(){
    let allCartDeleteBtn=document.getElementsByClassName('cartDeleteButton')


    for(eachBtn of allCartDeleteBtn){
        eachBtn.addEventListener('click',deleteCartProduct)
    }

    function deleteCartProduct(){
        let pid=Number(this.id.replace('cartDelete_',''))
        this.parentNode.parentNode.parentNode.parentNode.remove()
        console.log(pid)
        const xhr =new XMLHttpRequest()

        xhr.onload=function(){
            let data=this.responseText
            console.log(data)
        }

        xhr.open('DELETE','http://localhost/phpprojects/Ecommerce/api/removeFromCart.php')
        xhr.setRequestHeader('Content-type','text/json')
        xhr.send(`{
            "cid":${userId},
            "pid":${pid}
        }`)
    }

}