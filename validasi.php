* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #f0f2f5;
    display: flex;
}

.logo img {
    width: 80px;
    height: 80px;
    margin-bottom: -20px;
}

.sideNav {
    height: 100vh;
    width: 250px;
    position: fixed;
    background: #fff;
    border-right: 1px solid #ddd;
    padding: 25px 15px;
}

.logo {
    font-size: 22px;
    font-weight: bold;
    color: #0284c7;
    margin-bottom: 30px;
    text-align: center;
}

.nav-label {
    font-size: 12px;
    color: #999;
    margin-bottom: 10px;
    padding-left: 10px;
}

.sideNav ul { list-style: none; }
.sideNav ul li a {
    text-decoration: none;
    color: #444;
    display: block;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 5px;
}

.sideNav ul li a:hover {
    background: #e0f2fe;
    color: #0284c7;
}

.container {
    margin-left: 250px;
    padding: 30px;
    width: 100%;
}

.header-biru {
    background: linear-gradient(to right, #0284c7, #06b6d4);
    color: white;
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 25px;
}

.kartu-stats {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
}

.box {
    background: white;
    padding: 20px;
    border-radius: 12px;
    flex: 1;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

table {
    width: 100%;
    background: white;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

th { background: #f8f9fa; color: #666; font-size: 13px; }

.btn-aksi {
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    cursor: pointer;
    border: none;
}

.bg-kuning { background: #fef3c7; color: #92400e; }
.bg-hijau { background: #dcfce7; color: #166534; }
.bg-merah { background: #fee2e2; color: #991b1b; }