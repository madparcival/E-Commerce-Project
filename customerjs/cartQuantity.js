function addQuantityFunctionality(){
    let allCartUpdateBtn=document.getElementsByClassName('cartUpdateButton')
    const toastLiveExample = document.getElementById('liveToast')
    console.log(toastLiveExample)

    for(eachBtn of allCartUpdateBtn){
        eachBtn.addEventListener('click',updateQuantity)
        
    }

    function updateQuantity(){
        this.innerText='Updated'
        setTimeout(()=>{
            this.innerText='Update'
        },500)
        let pid=Number(this.id.replace('cartUpdate_',''))
        console.log(pid)
        let newQuantity=this.previousElementSibling.value

        const xhr =new XMLHttpRequest()
        xhr.onload=function(){
            let data=JSON.parse(this.responseText)
            toastLiveExample.lastElementChild.innerText=data['message']
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastBootstrap.show()
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


