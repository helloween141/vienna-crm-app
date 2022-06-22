export const months: any = {
    'January': 'Январь',
    'February': 'Февраль',
    'March': 'Март',
    'April': 'Апрель',
    'May': 'Май',
    'June': 'Июнь',
    'July': 'Июль',
    'August': 'Август',
    'September': 'Сентябрь',
    'October': 'Октябрь',
    'November': 'Ноябрь',
    'December': 'Декабрь'
}

const now = new Date().getUTCFullYear()
export const years: number[] = Array(now - (now - 13)).fill('').map((v, idx) => now - idx)

export const taskStatuses: any = {
    'new': 'Передано специалисту',
    'progress': 'В процессе выполнения',
    'complete': 'Выполнено',
    'waiting_answer': 'Ожидается ответ клиента',
    'waiting_payment': 'Ожидается оплата клиента',
    'additional': 'По доп. соглашению',
    'cancel': 'Отложено/отменено'
}

export const taskTypes: any = {
    'consultation': 'Консультация',
    'content': 'Работа по контенту',
    'code': 'Доработка кода',
    'design': 'Дизайн',
    'configure': 'Конфигурирование системы',
    'warranty': 'Гарантийные работы',
    'other': 'Другое'
}
