<?php
$jsonData = '{
    "techquest_id": "123",
    "TeamName": "wjeri",
    "TeamLeader": "wehw",
    "Memberone": "wgejhw",
    "MemberTwo": "hewe",
    "Email": "gshasg434dg@1hjhd.dfg",
    "Mobile_No": "1831180918",
    "Knowlegde_Bowl": "KnowlegdeBowl",
    "Quizardry": "Quizardry",
    "Tech_vein": null,
    "Design_up": null,
    "CodeLog": null,
    "ScreenShot": null,
    "CollegeName": "wgejhwge",
    "verification": null
}';

$data = json_decode($jsonData, true);

if ($data === null) {
    echo "Invalid JSON data!";
    exit();
}

echo "TechQuest ID: " . $data['techquest_id'] . "<br>";
echo "Team Name: " . $data['TeamName'] . "<br>";
echo "Team Leader: " . $data['TeamLeader'] . "<br>";
echo "Member One: " . $data['Memberone'] . "<br>";
echo "Member Two: " . $data['MemberTwo'] . "<br>";
echo "Email: " . $data['Email'] . "<br>";
echo "Mobile No: " . $data['Mobile_No'] . "<br>";
echo "Knowledge Bowl: " . $data['Knowlegde_Bowl'] . "<br>";
echo "Quizardry: " . $data['Quizardry'] . "<br>";
echo "Tech Vein: " . ($data['Tech_vein'] !== null ? $data['Tech_vein'] : "Not provided") . "<br>";
echo "Design Up: " . ($data['Design_up'] !== null ? $data['Design_up'] : "Not provided") . "<br>";
echo "Code Log: " . ($data['CodeLog'] !== null ? $data['CodeLog'] : "Not provided") . "<br>";
echo "Screenshot: " . ($data['ScreenShot'] !== null ? $data['ScreenShot'] : "Not provided") . "<br>";
echo "College Name: " . $data['CollegeName'] . "<br>";
echo "Verification: " . ($data['verification'] !== null ? $data['verification'] : "Not provided") . "<br>";
?>
