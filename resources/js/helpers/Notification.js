class Notification {
    notify($type) {
        let message;
        switch ($type) {
            case 'success':
                message = 'Successfully Done!'
            case 'alert':
                message = 'Are you sure?'
            case 'error':
                message = 'Something went wrong!'
            case 'warning':
                message = 'Opps Wrong!'

        }
        new Noty({
            type: $type,
            text: message,
            layout: "topRight",
            timeout: 1000
        }).show();
    }
}

export default Notification = new Notification()
