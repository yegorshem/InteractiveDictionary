/**
 * Created by Axum on 10/15/2016.
 */

var $table = $('#studentTable');


            $table.bootstrapTable({
                text: String,
                voice: String,

                inputOnClick: 'responsiveVoice.speak(text);',
                type: 'button',
                value: '🔊 Play'
            });