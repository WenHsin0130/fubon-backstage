// 當網頁載入時執行以下程式碼

window.addEventListener("load", async () => {
    // 從 Firebase 資料庫取得 qaChatLog 和 member 資料
    const [memberSnapshot] = await Promise.all([
        firebase.database().ref("member").once("value")
    ]);

    const memberData = [];

    Object.entries(memberSnapshot.val()).forEach(([memberKey, memberValue]) => {

        // 聊天紀錄和會員資料合併
        const memberGender = memberValue.gender || null;
        const memberBirthday = memberValue.birthday || null;

        const birthYear = parseInt(memberBirthday?.match?.(/\d{4}/)?.[0]);
        const currentYear = new Date().getFullYear();
        const age = birthYear ? currentYear - birthYear : "未填寫";

        memberData.push({
            Gender: memberGender,
            Age: age
        });
    });

    // 建立 DataTable，顯示聊天紀錄相關資訊
    const table = $("#myTable").DataTable({
        data: memberData,
        columns: [
            { data: "Gender", defaultContent: "未填寫" },
            { data: "Age", defaultContent: null }
        ]
    });

    // 監聽 minAge select 的變化
    $("#minAge").on("change", function() {
        const minAge = parseInt($(this).val());
        const filteredMemberData = memberData.filter(member => parseInt(member.Age) >= minAge);
        table.clear();
        table.rows.add(filteredMemberData).draw();
    });
});


