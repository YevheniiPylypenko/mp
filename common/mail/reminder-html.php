<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\MiscHelpers;
use frontend\models\Meeting;
use frontend\models\UserContact;
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */
?>
<tr>
  <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
    <center>
      <table cellspacing="0" cellpadding="0" width="600" class="w320">
        <tr>
          <td class="header-lg">
            Reminder of Your Meeting
          </td>
        </tr>
        <tr>
          <td class="free-text">
            Just a reminder about your upcoming meeting <?php echo $display_time; ?>
            <?php
            // this code is similar to code in finalize-html
            if ($chosen_place!==false) {
            ?>
            &nbsp;at <?php echo $chosen_place->place->name; ?>&nbsp;
              (<?php echo $chosen_place->place->vicinity; ?>, <?php echo HTML::a(Yii::t('frontend','map'),$links['view_map']); ?>)
              <?php
            } else {
            ?>
            &nbsp;via phone or video conference.
            <?php
              }
            ?>
            <br />
            Click below to view more details to view the meeting page.
          </td>
        </tr>
      <tr>
        <td class="button">
          <div><!--[if mso]>
            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:45px;v-text-anchor:middle;width:155px;" arcsize="15%" strokecolor="#ffffff" fillcolor="#ff6f6f">
              <w:anchorlock/>
              <center style="color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;">My Account</center>
            </v:roundrect>
          <![endif]--><a class="button-mobile" href="<?php echo $links['view'] ?>"
          style="background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Visit Meeting Page</a></div>
        </td>
      </tr>
      <tr>
        <td class="mini-large-block-container">
          <table cellspacing="0" cellpadding="0" width="100%"  style="border-collapse:separate !important;">
            <tr>
              <td class="mini-large-block">
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td style="text-align:left; padding-bottom: 30px;">
                      <strong>Helpful options:</strong>
                      <p>
                        <?php
                          echo HTML::a(Yii::t('frontend','Inform them I\'m running late.'),$links['running_late']);
                        ?>
                      </p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </center>
  </td>
</tr>
<?php echo \Yii::$app->view->renderFile('@common/mail/section-footer-dynamic.php',['links'=>$links]) ?>
