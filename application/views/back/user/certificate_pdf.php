<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vertical Business Card</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Roboto, Arial, Helvetica, sans-serif;
            position: relative;
        }
        h1, h2, h3, h4, p {
            margin: 0px;
        }
        ul, li, ol {
            margin: 0px;
            padding: 0px;
            list-style: none;
        }
        table {
            width: 100%;
            max-width: 950px;
            margin: 0 auto;
            border-collapse: collapse;
            position: relative;
        }
        td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }
        .top-text h3 {
            font-size: 25px;
            color: #390c83;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .top-text p {
            font-size: 18px;
            color: #390c83;
            font-weight: 500;
            text-transform: uppercase;
        }
        .certificate-title {
            font-size: 55px;
        }
        .background-image {
            content: "";
            background: url('<?php echo base_url(); ?>uploads/other_images/certificate.jpg') no-repeat center;
            background-size: cover;
            width: 950px;
            height: 950px;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>
<body>
    <section style="width: 100%;">
        <table border="" class="background-image">
            <tr>
                <td style="width: 33%;">
                    <img src="<?php echo base_url(); ?>uploads/other_images/logo_front_rni.png" alt="logo" style="width: 200px; margin-left: auto; margin-right: auto;" />
                </td>
                <td style="width: 33%;" class="top-text">
                    <h3>AKHAND BHARAT <br> (DAILY NEWS)</h3>
                </td>
                <td style="width: 33%;">
                    <img src="<?php echo base_url(); ?>uploads/other_images/managed_touch_fingure.png" style="width: 200px;" />
                </td>
            </tr>
            <tr>
                <td colspan="3" class="top-text">
                    <h3 class="certificate-title">CERTIFICATE</h3>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="top-text">
                    <h3>OF ADVERTISEMENT AGENCY</h3>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="header_right">
                    <p>પત્ર ક્રમાંક :- 2024000<?php echo $user_detail['id']; ?></p>
                    <p>તારીખ :- <?php echo $date; ?></p>
                </td>
            </tr>
        </table>
    </section>

    <input type="hidden" id="names" value="<?php echo $user_detail['name']; ?>">

   
       <script>
    var name = document.getElementById("names").value;

    document.addEventListener("DOMContentLoaded", function() {
        html2canvas(document.querySelector("table"), {
            scale: 3, // Increase the scale for higher resolution
            useCORS: true, // Enable cross-origin images to be captured
            allowTaint: true, // Allow cross-origin tainting (optional)
            logging: true, // Enable logging for debugging
            windowWidth: document.documentElement.scrollWidth, // Full width of the content
            windowHeight: document.documentElement.scrollHeight // Full height of the content
        }).then(canvas => {
            const imgData = canvas.toDataURL("image/png", 1.0);
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('l', 'mm', 'a4'); // Set to 'l' for landscape orientation

            const imgWidth = 287; // Adjusted for landscape (A4 width in mm is 297, so leave some margin)
            const pageHeight = pdf.internal.pageSize.height;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            // Centering the image
            const xOffset = (pdf.internal.pageSize.width - imgWidth) / 2;

            let heightLeft = imgHeight;
            let position = 0;

            // Add image to PDF, centered
            pdf.addImage(imgData, 'PNG', xOffset, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', xOffset, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            pdf.save(name + '_certificate.pdf');
        });
    });
</script>
   
</body>
</html>
