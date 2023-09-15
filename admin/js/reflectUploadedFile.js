document.getElementById('imageInput').addEventListener('change',function(){
    if(this.files[0]){
        let imgURL=URL.createObjectURL(this.files[0])
        document.getElementById('productImage').setAttribute('src',imgURL)
    }
})