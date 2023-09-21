function addQuantityFunctionality(){
    let allCartUpdateBtn=document.getElementsByClassName('cartUpdateButton')


    for(eachBtn of allCartUpdateBtn){
        eachBtn.addEventListener('click',updateQuantity)
    }

    function updateQuantity(){
        let pid=Number(this.id.replace('cartUpdate_',''))
        console.log(pid)
        let newQuantity=this.previousElementSibling.value

        const xhr =new XMLHttpRequest()
        xhr.onload=function(){
            let data=this.responseText
            console.log(data)
        }
        xhr.open('POST','http://localhost/phpprojects/Ecommerce/api/quantityUpdate.php')
        xhr.setRequestHeader('Content-type','text/json')
        xhr.send(`{
            "cid":${userId},
            "pid":${pid},
            "quantity":${newQuantity}
        }`)
    }

}


