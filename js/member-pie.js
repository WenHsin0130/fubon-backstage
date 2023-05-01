window.addEventListener("load", async () => {

    // 從 Firebase 資料庫取得 qaChatLog 和 member 資料
    const [memberSnapshot] = await Promise.all([
        firebase.database().ref("member").once("value")
    ]);
    
    //allMember
    const allMemberGender = { male: 0, female: 0 };
    const allMemberAge = [];
    
    Object.entries(memberSnapshot.val()).forEach(([memberKey, memberValue]) => {
    
        // 聊天紀錄和會員資料合併
        const memberGender = memberValue.gender || null;
        const memberBirthday = memberValue.birthday || null;
    
        const birthYear = parseInt(memberBirthday?.match?.(/\d{4}/)?.[0]);
        const currentYear = new Date().getFullYear();
        const age = currentYear - birthYear;
    
        const ageGroup = Math.floor(age / 10) * 10 + 10;
        if (!allMemberAge[ageGroup]) {
            allMemberAge[ageGroup] = 0;
        }
        allMemberAge[ageGroup] += 1;
    
        if (memberGender === '男') {
            allMemberGender.male += 1;
        } else if (memberGender === '女') {
            allMemberGender.female += 1;
        }
    
    });
    
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCharts);
    
    function drawCharts() {
        
        const memberGenderArray = [['Gender', 'Count']];
        const memberAgeArray = [['Age', 'Count']];
    
        Object.entries(allMemberGender).forEach(([key, value]) => {
            let genderKey;
            if(key === 'male') {
                genderKey = "男性";
            }
            else {
                genderKey = "女性";
            }
            memberGenderArray.push([genderKey, value]);
        });
    
        Object.entries(allMemberAge).forEach(([key, value]) => {
            const toString = (key-10).toString() + ' 歲（含）以上至 ' + (key).toString() + ' 歲';
            memberAgeArray.push([toString, value]);
        });
    
        const chartMemberOptions = {
            title: `共 ${allMemberGender.male+allMemberGender.female} 位保戶（男性：${allMemberGender.male} / 女性：${allMemberGender.female}）`,
            legend: { alignment: 'end' }
        };
    
        const chartMemberGender = new google.visualization.PieChart(document.getElementById('piechart-memberGender'));
        chartMemberGender.draw(google.visualization.arrayToDataTable(memberGenderArray), chartMemberOptions);
    
        const chartMemberAge = new google.visualization.PieChart(document.getElementById('piechart-memberAge'));
        chartMemberAge.draw(google.visualization.arrayToDataTable(memberAgeArray), chartMemberOptions);
        
    }

});