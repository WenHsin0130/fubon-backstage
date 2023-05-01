// 當網頁載入時執行以下程式碼

window.addEventListener("load", async () => {
    // Firebase qaChatLog
    const [chatSnapshot, memberSnapShot] = await Promise.all([
        firebase.database().ref("qaChatLog").once("value"),
        firebase.database().ref("member").once("value"),
    ]);


    const memberData = {};

    Object.entries(memberSnapShot.val()).forEach(([memberKey, memberValue]) => {
        
        const memberGender = memberValue.gender || null;
        const memberBirthday = memberValue.birthday || null;
    
        const birthYear = parseInt(memberBirthday?.match?.(/\d{4}/)?.[0]);
        const currentYear = new Date().getFullYear();
        const memberAge = currentYear - birthYear;
    
        const ageGroup = Math.floor(memberAge / 10) * 10;

        if (memberAge !== null) {
            if (!memberData[ageGroup]) {
                memberData[ageGroup] = { 男: 0, 女: 0};
            }
            memberData[ageGroup][memberGender] += 1;
        }

    });   


    const chatData = [];
    const chatMemberData = {};

    Object.entries(chatSnapshot.val()).forEach(([chatKey, chatValue]) => {
        
        const Timestamp = new Date(parseInt(chatKey)).toLocaleString();
        const chatPrompt = chatValue.Prompt;
        const displayName = chatValue.displayName;
        const chatGender = chatValue.gender || null;
        const chatAge = chatValue.age || null;
        const ageGroup = Math.floor(chatAge / 10) * 10;

        if (displayName && 
            (displayName.includes('-') || displayName === '優惠活動' || displayName === '常見問題' || displayName === 'Default Welcome Intent' || displayName === 'Default Fallback Intent')) {
            return;
        }

        if (chatAge !== null) {
            if (!chatMemberData[ageGroup]) {
                chatMemberData[ageGroup] = { 男: 0, 女: 0};
            }
            chatMemberData[ageGroup][chatGender] += 1;
        }

        chatData.push({
            Timestamp,
            Prompt: chatPrompt,
            DisplayName: displayName,
            Gender: chatGender,
            Age: chatAge
        });
    });   

    // 建立 DataTable，顯示聊天紀錄相關資訊
    const table = $("#myTable").DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Chinese-traditional.json"
        },
        data: chatData,
        columns: [
            { data: "Timestamp", defaultContent: "錯誤：Timestamp未成功接收" },
            { data: "Prompt", defaultContent: "錯誤：Prompt未成功接收" },
            { data: "DisplayName", defaultContent: "錯誤：webhook未開啟'" },
            { data: "Gender", defaultContent: "未登入" },
            { data: "Age", defaultContent: null }
        ]
    });


    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCharts);
    google.charts.setOnLoadCallback(drawMemberCharts);
    
    function drawCharts(gender, minAge, maxAge) {
        
        const chatAgeArray = [['Age', 'Count']];
    
        let filteredChatMemberData = chatMemberData;

        if (gender) {
            filteredChatMemberData = Object.fromEntries(
                Object.entries(filteredChatMemberData).filter(([ageGroup, genderData]) => genderData[gender] > 0)
            );
        }

        const minAgeValue = minAge !== null && minAge !== undefined ? minAge : 0;
        const maxAgeValue = maxAge !== null && maxAge !== undefined ? maxAge : 0;

        if (minAgeValue || maxAgeValue) { 

            
            filteredChatMemberData = Object.fromEntries(
                Object.entries(filteredChatMemberData).filter(([ageGroup, genderData]) => {
                    const isAgeInRange = (!minAgeValue || ageGroup >= minAgeValue) && (!maxAgeValue || ageGroup < maxAgeValue);
                    return isAgeInRange;
                })
            );
        }
        
        let totMale = 0;
        let totFemale = 0;
        let total = 0;

        let totChat = 0;
    
        Object.entries(filteredChatMemberData).forEach(([ageGroup, genderData]) => {
            const toAge = parseInt(ageGroup)+10;
            const toString = ageGroup.toString() + '(含)～ ' + toAge.toString() + ' 歲';
            totMale += genderData['男'];
            totFemale += genderData['女'];
            total = genderData['男'] + genderData['女'];
            totChat += total;
            chatAgeArray.push([toString, total]);
        });
    
    
        const chartChatOptions = {
            title: `共 ${totChat} 筆詢問資料（男性：${totMale} / 女性：${totFemale}）`,
            legend: { alignment: 'end' },
            dataLabels: true
        };
        
        const chartChatAge = new google.visualization.PieChart(document.getElementById('piechart-chatAge'));
        chartChatAge.draw(google.visualization.arrayToDataTable(chatAgeArray), chartChatOptions);
        
    }

    function drawMemberCharts() {
        
        const memberAgeArray = [['Age', 'Count']];
        
        let memberMale = 0;
        let memberFemale = 0;
        let memberTotal = 0;
        let totMember = 0;
    
        Object.entries(memberData).forEach(([ageGroup, genderData]) => {
            const toAge = parseInt(ageGroup)+10;
            const toString = ageGroup.toString() + '(含)～ ' + toAge.toString() + ' 歲';
            memberMale += genderData['男'];
            memberFemale += genderData['女'];
            memberTotal = genderData['男'] + genderData['女'];
            totMember += memberTotal;
            memberAgeArray.push([toString, memberTotal]);
        });
    
        const chartMemberOptions = {
            title: `共 ${totMember} 位保戶（男性：${memberMale} / 女性：${memberFemale}）`,
            legend: { alignment: 'end' },
            dataLabels: true
        };
        
        const chartMemberAge = new google.visualization.PieChart(document.getElementById('piechart-memberAge'));
        chartMemberAge.draw(google.visualization.arrayToDataTable(memberAgeArray), chartMemberOptions);
    
        
    }
    

    // 監聽 minAge、maxAge、gender select 的變化
    $("#minAge, #maxAge, #genderSelect").on("change", function() {
        const minAge = parseInt($("#minAge").val());
        const maxAge = parseInt($("#maxAge").val());
        const gender = $("#genderSelect").val();
        let filteredChatData = chatData;

        // 過濾年齡大於等於 minAge 且小於等於 maxAge 的成員
        if (!isNaN(minAge)) {
            filteredChatData = filteredChatData.filter(member => parseInt(member.Age) >= minAge);
        }
        if (!isNaN(maxAge)) {
            filteredChatData = filteredChatData.filter(member => parseInt(member.Age) <= maxAge);
        }
        // 如果 gender 不是空字串，則過濾出性別等於指定值的成員
        if (gender !== "") {
            filteredChatData = filteredChatData.filter(member => member.Gender === gender);
        }

        // 更新表格資料
        table.clear();
        table.rows.add(filteredChatData).draw();

        drawCharts(gender, minAge, maxAge);
    });


    
});


