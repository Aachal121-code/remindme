<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReMindMe - dashboard</title>
</head>
<body>
    <section class="dashboard">
        <div class="navbar">
            <div class="logo">
                <p>ReMindMe</p>
            </div>
            <div class="addDocument">
                <button id="addDocumentBtn">+ Add Document</button>
            </div>
            <div class="setting">
                <button id="settingBtn">⚙️</button>
            </div>
        </div>
        <div class="dashboard-container">
            <div class="quickStatus">
                <h2>Quick Status</h2>
                <div class="status-card">
                    <div class="valid">
                        <h3>🟢 Valid : </h3>
                        <p id="validCount">0</p>
                    </div>
                    <div class="expired">
                        <h3>🔴 Expired : </h3>
                        <p id="expiredCount">0</p>
                    </div>
                    <div class="aboutToExpire">
                        <h3>🟠 About to Expire : </h3>
                        <p id="aboutToExpireCount">0</p>
                    </div>
                </div>
            </div>
            <div class="upcoming-expiry">
                <h2>Upcoming Expiry</h2>
                <div class="expiry-list" id="expiryList">
                    <p>No upcoming expiries.</p>
                </div>
            </div>
            <div class="document-list">
                <h2>Your Documents</h2>
                <div class="documents" id="documentList">
                    <p>No documents added yet.</p>
                </div>
            </div>

        </div>
    </section>
        







</body>
</html>