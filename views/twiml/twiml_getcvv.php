<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<Response>

    <Gather action="<?php echo $data['redirect']; ?>" method="GET" numDigits="4">

        <Say voice="woman"><?php echo $data['ivr_ask_cvv']; ?></Say>

    </Gather>

</Response>

