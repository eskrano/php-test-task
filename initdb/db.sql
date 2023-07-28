USE test;

CREATE TABLE IF NOT EXISTS WebViews
(
    id          INT AUTO_INCREMENT,
    ip_address  VARCHAR(40)   NOT NULL,
    user_agent  VARCHAR(255)  NOT NULL,
    view_date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    page_url    VARCHAR(200) NOT NULL,
    views_count INT       DEFAULT 1,
    PRIMARY KEY (id),
    UNIQUE KEY combined_key (ip_address, user_agent, page_url)
);
