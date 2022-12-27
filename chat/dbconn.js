const mysql = require("mysql");

// const connection = mysql.createConnection({
//   host: 'localhost',
//   user: 'root',
//   password: '',
//   database: 'correction',
// });
const config = {
  host: 'localhost',
  user: 'correction',
  password: 'af]frbg24eay3@42faeb\$aw',
  database: 'correction',
}

exports.select = async (column = "*", table = "", where = "1", callback) => {
  const connection = mysql.createConnection(config);
  connection.query(`SELECT ${column} FROM ${table} WHERE ${where}`, (error, rows) => {
    if (error) callback(error, null);
    if (rows.length == 0) callback(error, "0");
    callback(null, rows[0].idx);
  });
  connection.end();
}

exports.selectT = async (column = "*", table = "", where = "1", callback) => {
  const connection = mysql.createConnection(config);
  connection.query(`SELECT ${column} FROM ${table} WHERE ${where}`, (error, rows) => {
    if (error) callback(error, null);
    if (rows.length == 0) callback(error, "0");
    callback(null, rows[0].token);
  });
  connection.end();
}

exports.insert = async (table = "", values = "") => {
  const connection = mysql.createConnection(config);
  connection.query(`INSERT INTO ${table} VALUES(${values})`);
  connection.end();
}