alertBox = {
    showAlertBox : (from, align, color, message, timer) => {
        $.notify(
            {
                icon: "tim-icons icon-bell-55",
                message: message,

            }, {
                type: color,
                timer: timer,
                placement: {
                    from: from,
                    align: align
                }
            }
        )
    }
}
