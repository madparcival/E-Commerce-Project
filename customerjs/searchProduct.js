let searchButton=document.getElementById('searchBtn')
searchButton.addEventListener('input',getProduct)
let searchResults=document.getElementById('searchOutput')

function getProduct(){
    console.log(searchButton.value)
    const xhr =new XMLHttpRequest()

    xhr.onload=function(){
        let data=JSON.parse(this.responseText)
        for (row of data['message']){
            searchResults.innerText=row['Name']
        }
    }

    xhr.open('POST','http://localhost/phpprojects/Ecommerce/api/searchProduct.php')
    xhr.setRequestHeader('Content-type','text/json')
    xhr.send(`{
        "Name":"${searchButton.value}"
    }`)
}