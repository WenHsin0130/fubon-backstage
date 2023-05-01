// 當網頁載入時執行以下程式碼
window.addEventListener("load", async () => {

    // 從 Firebase 資料庫取得 qaChatLog 和 member 資料
    const [chatSnapshot, memberSnapshot] = await Promise.all([
        firebase.database().ref("qaChatLog").orderByKey().once("value"),
        firebase.database().ref("member").once("value")
    ]);
       
    const chatData = [];

    Object.entries(chatSnapshot.val()).forEach(([chatKey, chatValue]) => {
        const Timestamp = new Date(parseInt(chatKey)).toLocaleString();
        const chatAndroidId = chatValue.AndroidId;
        const chatPrompt = chatValue.Prompt;
        const displayName = chatValue.displayName;
        if (displayName && 
            (displayName.includes('-') || displayName === '優惠活動' || displayName === '常見問題' || displayName === 'Default Welcome Intent' || displayName === 'Default Fallback Intent69')) {
            return;
        }
        
        // 找聊天紀錄的會員資料
        const memberData = Object.entries(memberSnapshot.val()).find(([memberKey, memberValue]) => {
            const devices = memberValue.devices || {};
            const deviceKey = Object.keys(devices).find(key => key === chatAndroidId); //找id
            return deviceKey !== undefined;
        });

        // 聊天紀錄和會員資料合併
        if (memberData) {
            const [memberKey, memberValue] = memberData;
            const memberGender = memberValue.gender || null;
            const memberBirthday = memberValue.birthday || null;
            const birthYear = parseInt(memberBirthday?.match?.(/\d{4}/)?.[0]);
            const currentYear = new Date().getFullYear();
            const age = birthYear ? currentYear - birthYear : "未登入";

            chatData.push({
                Timestamp,
                chatPrompt,
                displayName,
                Gender: memberGender,
                Birthday: memberBirthday,
                Age: age
            });
        } else {
            chatData.push({
                Timestamp,
                chatPrompt,
                displayName,
                Gender: null,
                Birthday: null,
                Age: null
            });
        }
    });

    // 建立 DataTable，顯示聊天紀錄相關資訊
    const table = $("#myTable").DataTable({
        data: chatData,
        columns: [
            { data: "Timestamp", defaultContent: "錯誤：Timestamp未成功接收"  },
            { data: "chatPrompt", defaultContent: "錯誤：Prompt未成功接收" },
            { data: "displayName", defaultContent: "錯誤：webhook未開啟" },
            { data: "Gender", defaultContent: "未登入" },
            { data: "Age", defaultContent: null }
        ]
    });
    
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts(selectedGender, selectedMinAge, selectedMaxAge) {
        
        /* pie-計算性別年齡的人數總和 */
        const ageCounts = {};

        chatData.forEach(chat => {
            const age = chat.Age;
            const gender = chat.Gender;
            const genderCase = (!selectedGender || gender === selectedGender);
            const minAgeCase = (!selectedMinAge || age >= selectedMinAge);
            const maxAgeCase = (!selectedMaxAge || age < selectedMaxAge);

            if (typeof age === "number" && genderCase && minAgeCase && maxAgeCase) {
                const ageGroup = Math.floor(age / 10) * 10 + 10;
                if (!ageCounts[ageGroup]) {
                    ageCounts[ageGroup] = {
                        total: 0,
                        male: 0,
                        female: 0
                    };
                }
                ageCounts[ageGroup].total += 1;
                if (gender === '男') {
                    ageCounts[ageGroup].male += 1;
                } else if (gender === '女') {
                    ageCounts[ageGroup].female += 1;
                }
            }

        });


        const dataAgeArray = [['Age', 'Count']];
        const dataGenderArray = [['Gender', 'Count']];
        let male = 0;
        let female = 0;

        Object.entries(ageCounts).forEach(([key, value]) => {
            const toString = (key-10).toString() + ' 歲（含）以上至 ' + (key).toString() + ' 歲';
            male += value.male;
            female += value.female;
            dataAgeArray.push([toString, value.total]);
        });
        dataGenderArray.push(['男性', male], ['女性', female]);

        const chartAge = new google.visualization.PieChart(document.getElementById('piechart-Age'));
        chartAge.draw(google.visualization.arrayToDataTable(dataAgeArray));

        const chartGender = new google.visualization.PieChart(document.getElementById('piechart-Gender'));
        chartGender.draw(google.visualization.arrayToDataTable(dataGenderArray));
        
    }
    /* pie-計算性別年齡的人數總和 */

    const genderSelect = $('#genderSelect');
    const minAge = $('#minAge');
    const maxAge = $('#maxAge');

    /* 篩選 */
    function filterRows(selectedGender, selectedMinAge, selectedMaxAge) {
        table.column(3).search(selectedGender);
        table.draw();
    }

    genderSelect.add(minAge).add(maxAge).change(() => {
        const selectedGender = genderSelect.val();
        const selectedMinAge = parseInt(minAge.find(":selected").val());
        const selectedMaxAge = parseInt(maxAge.find(":selected").val());
        filterRows(selectedGender);
        drawCharts(selectedGender, selectedMinAge, selectedMaxAge);
    });

});