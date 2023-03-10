import {getData} from "../../request.js";
import {PopUp} from "../../popup/popUp.js";
import {PopUpFunctions} from "../../popup/popupFunctions.js";

let popUpRequest = new PopUp();

let popUpFunctions = new PopUpFunctions();

let requests = document.querySelectorAll('.requestView');

requests = Array.from(requests);

for(let i = 0; i < requests.length; i++) {
    requests[i].addEventListener('click', (e) => showReqPopUp(e));
}

async function showReqPopUp(e) {
    let element = e.target;
    while(element.id === '') {
        element = element.parentElement;
    }

    let result = await getData('./requests/popup', 'POST', {"r.requestID": element.id});

    let data = result['requestDetails'];

    popUpRequest.clearPopUp();
    popUpRequest.setHeader('Request Details');

    popUpRequest.startSplitDiv();
    popUpRequest.startSplitDiv();
    popUpRequest.setBody(data,['postedDate','subcategoryName','urgency'],['Date Posted','Item','Urgency']);

    popUpRequest.endSplitDiv();
    popUpRequest.setBody(data,['expDate','amount'],['Valid until','Amount']);
    popUpRequest.endSplitDiv();

    popUpRequest.setButtons([{text:'Accept',classes:['btn-primary'],value:data['requestID'],func:acceptFun,cancel:false},]);
    popUpRequest.showPopUp();


}

const acceptFun = async (e) => {
    const reqId = e.target.value;
    const popUp = document.querySelector('#popUpContainer');
    popUp.style.display = 'none';

    showAcceptPopUp(popUp,e.target.value);


}

const showAcceptPopUp = (popUp,reqId) => {
    const amount = popUp.querySelector('#amount').value;
    const amountField = `<div class="form-group"><label class="form-label">Amount</label><input class="basic-input-field" id="amount" type="text" value="${amount}" disabled=""></div>`;
    const item = popUp.querySelector('#subcategoryName').value;
    const itemField = `<div class="form-group"><label class="form-label">Item</label><input class="basic-input-field" id="item" type="text" value="${item}" disabled=""></div>`;
    const acceptedValue = `<input type="number" id="acceptedAmount" value="${amount}" min="1" max="${amount}"/>`

    const buttons = `<div class='popup-btns'>
    <button class='btn btn-primary' id='confirm' value="${reqId}">Confirm</button>
    <button class='btn btn-secondary' id='cancel'>Cancel</button>
    </div>`

    const acceptPopUp = document.createElement('div');
    acceptPopUp.id = 'acceptPopUp';
    acceptPopUp.classList.add('popup');
    acceptPopUp.innerHTML = `<div class='form-split'> ${itemField} ${amountField}</div>` + acceptedValue + buttons;

    acceptPopUp.querySelector('#cancel').addEventListener('click', () => cancelAccept());
    acceptPopUp.querySelector('#confirm').addEventListener('click', (e) => confirm(e));

    document.querySelector('#popUpBackground').appendChild(acceptPopUp);
}

const cancelAccept = () => {
    const acceptPopUp = document.querySelector('#acceptPopUp');
    acceptPopUp.remove();
    document.querySelector('#popUpContainer').style.display = 'block';
}

const confirm = async (e) => {
    const acceptPopUp = document.querySelector('#acceptPopUp');
    const acceptedAmount = acceptPopUp.querySelector('#acceptedAmount').value;
    const amount = acceptPopUp.querySelector('#amount').value;
    const reqId = acceptPopUp.querySelector('#confirm').value;

    let result = await getData('./requests/accept', 'POST', {"requestID": reqId, "acceptedAmount": acceptedAmount, "amount": amount});

    if(result['success']) {
        popUpRequest.clearPopUp();
        popUpRequest.hidePopUp();
        acceptPopUp.remove();
        document.querySelector('#popUpContainer').style.display = 'block';
        document.getElementById(reqId).querySelector('button').click();
    } else {
        console.log(result);
    }


}
