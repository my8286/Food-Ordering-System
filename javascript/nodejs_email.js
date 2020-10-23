/*let transporter = nodemailer.createTransport({
    service: ‘gmail’,
    host: ‘smtp.gmail.com’,
    secure: ‘true’,
    port: ‘465’,
    auth: {
    type: ‘OAuth2’, //Authentication type
    user: ‘manishyadav8286@gmail.com’, //For example, xyz@gmail.com
    clientId: ‘Mkyrsmvm’,
    clientSecret: ‘Mkyrsmvm’,
    refreshToken: ‘Mkyrsmvm’
         }
    });

    let mailOptions = {
        from: ‘manishyadav8286@gmail.com',
        to: ‘manishyadav8286@gmail.com’,
        subject: ‘This is subject’,
        text: ‘This is email content’
    };

    transporter.sendMail(mailOptions, function(e, r) {
        if (e) {
          console.log(e);}
        else {
          console.log(r);
            }
        transporter.close();
        });*/