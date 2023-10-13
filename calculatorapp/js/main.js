class Calculator {
    constructor(previousText,currentText) {
        this.previousText = previousText
        this.currentText = currentText
        this.clear()
    }
 
    clear() {
        this.currentValue = '';
        this.previousValue = '';
        this.operation = undefined;
    }
    deletenum(){
        this.currentValue = this.currentValue.toString().slice(0, -1)
    }

    appendNum(number) {
        if (number === '.' && this.currentValue.includes('.')) {
            return;
        }
        this.currentValue = this.currentValue.toString() + number.toString();
    }

    chooseoperation(operation) {
        if(this.currentValue === '') return;
        if(this.previousValue !== ''){ 
            this.compute();
        }
        this.operation = operation;
        this.previousValue = this.currentValue;
        this.currentValue = '';
    }

    compute(){
        let calculate
        const prev = parseFloat(this.previousValue)
        const current = parseFloat(this.currentValue)
        if(isNaN(prev) || isNaN(current)) return
        switch (this.operation) {
            case '+':
                calculate = prev + current
                break
            case '-':
                calculate = prev - current
                break
            case 'x':
                calculate = prev * current
                break
            case '÷':
                calculate = prev / current
                break
            default:
                text = "Wrong input"
        }
        this.currentValue = calculate
        this.operation = undefined
        this.previousValue = ''
    }
    updatedisplay() {
        if (this.operation) {
            this.previousText.innerText = `${this.getDisplayNumber(this.previousValue)} ${this.operation}`;
        } else {
            this.previousText.innerText = '';
        }
        this.currentText.innerText = this.getDisplayNumber(this.currentValue);
    }
    getDisplayNumber(number) {
        const stringNumber = number.toString();
        const integerPart = parseFloat(stringNumber.split('.')[0]);
        const decimalPart = stringNumber.split('.')[1];
        let integerDisplay;
        if (isNaN(integerPart)) {
            integerDisplay = '';
        } else {
            integerDisplay = integerPart.toLocaleString('en', { maximumFractionDigits: 0 });
            }
        if (decimalPart != null) {
            return `${integerDisplay}.${decimalPart}`;
        } else {
            return integerDisplay;
        }
        }
    }
    
    
    // updatedisplay(){
    //     this.currenttext.innerText = this.currentValue;
    //     if(this.operation != null){
    //         this.previoustext.innerText = `${this.previousValue} ${this.operation}`;
    //     } else {
    //         this.previoustext.innerText = '';
    //     } 
    // }

const numberbtn = document.querySelectorAll('[data-number]')
const operationbtn = document.querySelectorAll('[data-operation]')
const equalsign = document.querySelector('[data-equalsign]')
const deletebtn = document.querySelector('[data-delete]')
const clearbtn = document.querySelector('[data-clear]')
const previousText = document.querySelector('[data-previous]')
const currentText = document.querySelector('[data-current]')
 
const mainCalculator = new Calculator(previousText, currentText)

numberbtn.forEach(button => {
    button.addEventListener('click', () => {
        console.log("Button clicked! Number:",button.innerText)
        mainCalculator.appendNum(button.innerText)
        mainCalculator.updatedisplay()
    })
})

operationbtn.forEach(button => {
    button.addEventListener('click',() => {
        console.log("Button clicked!")
        mainCalculator.chooseoperation(button.innerText)
        mainCalculator.updatedisplay()
    })
})

equalsign.addEventListener('click', button => {
    console.log("Button clicked!")
    mainCalculator.compute()
    mainCalculator.updatedisplay()
})

clearbtn.addEventListener('click', button => {
    mainCalculator.clear()
    mainCalculator.updatedisplay()
})

deletebtn.addEventListener('click', button => {
    mainCalculator.deletenum()
    mainCalculator.updatedisplay( )
})