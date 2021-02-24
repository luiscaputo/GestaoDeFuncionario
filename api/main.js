function getUrl ()
{
    let requisition = new XMLHttpRequest();
    let url = 'https://localhost:3000';
    requisition.send('get', url, false)
    return requisition;
}
