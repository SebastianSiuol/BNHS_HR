import { Link } from "@inertiajs/react";

export default function Pagination({ data }) {
    const linkActiveClass = {
        true: "relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5",
        false: "relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150",
    };

    return (
        <div className={"flex items-center justify-between mt-8"}>
            <div>
              <p className={'text-sm font-normal text-gray-500  mb-4 md:mb-0 block w-full md:inline md:w-auto'}>

              Showing <span className={'font-semibold text-gray-900 '}>{data.from}</span> - <span className={'font-semibold text-gray-900 '}>{data.to}</span> of <span className={'font-semibold text-gray-900 '}>{data.total}</span>
              </p>
            </div>
            <div>
                {data.links.map((link) =>
                    link.url ? (
                        <Link
                            href={link.url}
                            key={link.label}
                            dangerouslySetInnerHTML={{
                                __html: link.label,
                            }}
                            className={
                                link.active
                                    ? linkActiveClass[true]
                                    : linkActiveClass[false]
                            }
                        />
                    ) : (
                        <span
                            key={link.label}
                            dangerouslySetInnerHTML={{
                                __html: link.label,
                            }}
                            className={
                                "relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                            }
                        ></span>
                    )
                )}
            </div>
        </div>
    );
}
