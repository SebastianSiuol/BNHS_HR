/**
* Table
* @param {object} data - The data of the table that will be used
* @param {string[]} headers - The array of strings that will be served as the column headers
* @param {ReactComponent} renderRow - The React Table Row component that will be used for renders
*/
export function Table({ data, headers, renderRow }) {
  return (
      <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table className="w-full text-sm text-left rtl:text-right text-gray-500">
              <thead className="text-sm text-white bg-blue-900 text-center">
                  <tr>

                      {headers.map((header, i) => (
                          <th className="px-6 py-3" key={i}>
                              {header}
                          </th>
                      ))}

                  </tr>
              </thead>
              <tbody>

                  {data.length === 0 ? (
                      <tr className="odd:bg-blue-100 even:bg-white border-b text-center">
                          <td
                              className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                              colSpan={headers.length}
                          >
                              No Data Found
                          </td>
                      </tr>
                  ) : (
                      data.map(renderRow)
                  )}

              </tbody>
          </table>
      </div>
  );
}



/***
 * Renders the Table Rows
 * @param {} data - The data of objects received from the Table Component
 * @param {()=>{}} columns - The columns of arrow functions
 */
export function TableRow({ data, columns }) {
  return (
      <tr className="odd:bg-blue-100 even:bg-white border-b text-center">
          {columns.map((col, i) => (
              <TableItem key={i}>{col(data)}</TableItem>
          ))}
      </tr>
  );
}

export function TableItem({ children }) {
  return (
      <td className="px-6 py-4 font-medium text-gray-900 truncate text-wrap">
          {children}
      </td>
  );
}
