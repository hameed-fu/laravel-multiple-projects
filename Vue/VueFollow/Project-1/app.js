new Vue({
    el: "#app",
    data: {
        title: "Vue dynamic title",
        name: "Ali",
        googleUrl: "https://www.google.com/",
        classes: ['bg','border'],
        text: 'Bind-Val',
        val: 20,
        message: 'No data',
        items: ["Alogan","Marchaki","Tamator","Pyaz","Palak","Showatal"],
        lists: [
            {Name: "Ali", Age: 30, Address: "Abbotabad"},
            {Name: "Aqib", Age: 16, Address: "Abbotabad"},
            {Name: "Sameer", Age: 20, Address: "Mardan"},
            {Name: "Gulab", Age: 25, Address: "Peshawar"},
        ],
        show: true
    },
    methods: {
        greeting(time){
            return `Good ${time} ${this.name}`
        },
        increase(param){
            console.log(param)
            return this.val++;
        },
        decrease(param){
            console.log(param)
            if(this.val == 0){
                return false;
            }
            return this.val--;
        },
        updateText(e){
             this.text = e.target.value
        },
        showData(){
            this.show = !this.show
        },
        
    }
})