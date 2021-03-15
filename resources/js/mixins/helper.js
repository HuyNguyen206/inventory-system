import AppStorage from "../helpers/AppStorage";

export default {
    methods: {
        carProductById(id){
            let cartProduct = this.cartProducts.find((p) => {
                return p.product_id == id
            })
            return cartProduct ? cartProduct : { product_quantity : 0}
        },
        checkLogin() {
            if (!User.loggedInAlready()) {
                this.$router.push({name: 'login'})
                return null
            } else {
                const token = AppStorage.getDataInLocalStorageByKey('token')
                return token
            }
        },
        formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
            try {
                decimalCount = Math.abs(decimalCount);
                decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

                const negativeSign = amount < 0 ? "-" : "";

                let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
                let j = (i.length > 3) ? i.length % 3 : 0;

                return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
            } catch (e) {
                console.log(e)
            }
        }
    },
    data() {
        return {
            errors: {}
        }
    }
}
