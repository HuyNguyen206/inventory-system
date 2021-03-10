class Notification {
    notify($type, message=null) {
        console.log($type,message )
        if(!message){
            console.log($type,message )
            switch ($type) {
                case 'success':
                    message = 'Successfully Done!'
                    break;
                case 'alert':
                    message = 'Are you sure?'
                    break;
                case 'error':
                    message = 'Something went wrong!'
                    break;
                case 'warning':
                    message = 'Opps Wrong!'
                    break;

            }
        }
        console.log($type,message )

        new Noty({
            type: $type,
            text: message,
            layout: "topRight",
            timeout: $type == 'error' ? 5000 : 1000
        }).show();
    }
}

export default Notification = new Notification()
