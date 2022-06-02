export const months: string[] = [
    'Январь',
    'Февраль',
    'Март',
    'Апрель',
    'Май',
    'Июнь',
    'Июль',
    'Август',
    'Сентябрь',
    'Октябрь',
    'Ноябрь',
    'Декабрь'
]

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
