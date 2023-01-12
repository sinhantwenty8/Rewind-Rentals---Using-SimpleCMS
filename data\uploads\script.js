let countofExtra = 1;
const addExtraButton = document.getElementById('add-extra-button');
const deleteExtraButton = document.getElementById('delete-extra-button');
const lastVisitText = document.getElementById('last-visit-text');

function addExtra(){
    countofExtra++;
    if(countofExtra > 1){
        deleteExtraButton.style.display = "block"
    }
    const form = document.getElementById("extra-products");
    form.insertAdjacentHTML("beforeend",`
                    <div id="extra-product-${countofExtra}">
                        <br><h3>Extra Product ${countofExtra}</h3>
                         <div class="extra-product">
                            <div class="form-group">
                                <label for="extra-product" class="label">Extra Product Name<span class="asterisk">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="extra-product" name="extra-product" class="form-control" required>
                                </div>
                            </div>
            
                            <div class="form-group">
                                <label for="extra-product-cost" class="label">Extra Product Costs<span class="asterisk">*</span></label>
                                <div class="input-group">
                                    <input type="number" id="extra-product-cost" name="extra-product-cost" class="form-control" required>
                                </div>
                            </div>
            
                            <div class="form-group">
                                <label for="extra-product-image" class="label">Extra Product Image<span class="asterisk">*</span></label>
                                <div class="input-group">
                                    <input type="file" id="extra-product-image" name="extra-product-image" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

    `);
}

function deleteExtra(){
    const extraProduct = document.getElementById(`extra-product-${countofExtra}`);
    extraProduct.remove()
    countofExtra--;
    if(countofExtra == 1){
        deleteExtraButton.style.display = "none"
    }
}

function validation(){
	
    const review = document.querySelectorAll('.review-description')
    const reviewTitle = document.getElementById('review-title')
    const reviewDescription = document.getElementById('review-description')
    if((reviewTitle.value == 0 || reviewTitle.value == null) && (reviewDescription.value == "" && reviewDescription.value == null)){
        return true
    }
    let boolean = false;
    review.forEach((entry)=>{
        let newEntry = (entry.value + "").split(" ");

        if(newEntry.indexOf('out') == 0){
            alert("Please key in ur rating")
            return boolean
        }

        let rating = newEntry[newEntry.indexOf("out")-1]
        newEntry = newEntry.join("");

        if(!newEntry.includes("outof5stars")){
            alert("You need to include x out of 5 stars in your review (where x must be a number from 0 to 5 allowing a single decimal place)");
        }else if(newEntry.includes("outof5stars")){
            let num = parseFloat(rating)

            if((rating.length == 1 || rating.length == 3)&& typeof num == 'number' && num >= 0 && num <= 5){
                boolean = true;
            }else if(num < 0){
                alert("Rating must be bigger than 0")
            }else if(num > 5){
                alert("Rating must be smaller or equal to 5")
            }else
                alert("Rating must be a number from 0 to 5 allowing a single decimal place")
            }
    })
    return boolean;
}

function displayCommission(){
    const rentalCostElement = document.getElementById("rental-cost")
    const commissionElement = document.getElementById('commission');
    const earningsElement = document.getElementById('earnings')
    let rentalCost;
    if(typeof rentalCostElement.value != 'number'){
        rentalCost = parseFloat(rentalCostElement.value);
    }else{
        rentalCost = rentalCostElement.value
    }
    let commission,earnAmount;


    if(rentalCost > 100 && rentalCost <= 250){
        commission = rentalCost * 15/100
        earnAmount = rentalCost - commission
    }else if(rentalCost > 250){
        commission = rentalCost * 10/100
        earnAmount = rentalCost - commission
    }else if(rentalCost <= 100){
        commission = rentalCost * 20/100
        earnAmount = rentalCost - commission
    }

    if(commission < 2){
        commission = 2
        earnAmount = rentalCost-commission
    }
    commissionElement.value = commission
    earningsElement.value = earnAmount
}

function showCategoryTextInput(){
    const dropdownBox = document.getElementById('categories')
    const inputCategory = document.getElementById('category')
    let selection = dropdownBox.value
    if(selection == 'create-category'){
        inputCategory.style.display = 'block'
        dropdownBox.style.marginBottom = '20px'
    }else{
        inputCategory.style.display = 'none'
        dropdownBox.style.marginBottom = '0px'
    }
}

function setCookie() {
    const d = new Date().toLocaleString('SG', {
        timeZone: 'Asia/Singapore',
        hour12: false
      })
    console.log(d)
    document.cookie = "date=" + d; 
  }
  
  function getCookie() {
    setCookie()
    let decodedCookie = decodeURIComponent(document.cookie);
    let d = decodedCookie.split("=");
    return d[1]
  }
  
  function checkCookie() {
    let date = getCookie();
    const lastPageUrl = document.referrer;
    lastPageUrlList = lastPageUrl.split("/")
    const lastPage = lastPageUrlList[lastPageUrlList.length-1];
    if (date == "" && date == null) {
      setCookie()
      let cookie = getCookie()
      lastVisitText.textContent = "Last visited date is " + cookie + ".Last visited page is " + lastPage
    } else {
       if (date != "" && date != null) {
         let cookie = getCookie()
         lastVisitText.textContent = "Last visited date is " + cookie + ".Last visited page is " + lastPage
         setCookie()
       }
    }
  
  }